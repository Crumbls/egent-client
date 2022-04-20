<?php
namespace Egent\Client\Controllers;

use App\Jobs\ImportOfficeByMlsId;
use Egent\Office\Models\Office;
use Egent\Listing\Models\Property;
use App\Models\Role;
use App\Policies\OfficePolicy;
use App\Services\ReColorado\Manager;
use App\Services\ReColorado\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Egent\Office\Controllers\AbstractController as Controller;

use App\Http\Requests\OfficeUpdateRequest;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    /**
     * @param \App\Http\Requests\OfficeStoreRequest|\Illuminate\Foundation\Http\FormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
	    // START
	    $user = $request->user();
	    abort_if(!$user, 404);
	    $office = $user->offices->last();
//        abort_if(!$office, 404);
	    $model = get_class($user);

	    /**
	     * We have some gross configuration for the rules, but it works for now.
	     */
	    $rules = [
		    'email' => [
			    'required',
			    'email',
		    ],
		    'name_first' => [
			    'required',
			    'string',
			    'min:1',
			    'max:256'
		    ],
		    'name_last' => [
			    'required',
			    'string',
			    'min:1',
			    'max:256'
		    ],
		    'agree_terms' => [
			    'required',
			    'numeric',
			    'in:1'
		    ],
		    'remember_me' => [
			    'sometimes',
			    'boolean'
		    ],
		    'password' => [
			    'required',
			    'min:5',
			    'max:256',
			    \Illuminate\Validation\Rules\Password::defaults()
		    ]
	    ];

	    $rules['email'][] = Rule::notIn([$user->email]);
	    if (!array_key_exists('email_alternate', $rules)) {
		    $rules['email_alternate'] = [
			    'sometimes',
			    'nullable',
			    'email',
			    'unique:users,email',
			    'unique:users,email_alternate'
		    ];
	    }

	    /**
	     * Written for future growth.
	     */
	    foreach(['phone'] as $key) {
		    if (!array_key_exists($key, $rules)) {
			    $rules[$key] = [
				    'sometimes',
				    'nullable',
				    'string',
				    'min:1',
				    'max:256'
			    ];
		    }
	    }

	    foreach(['name_middle', 'company_name', 'email_alternate', 'phone_ext','phone_alt','phone_alt_ext'] as $key) {
		    if (!array_key_exists($key, $rules)) {
			    $rules[$key] = [
				    'sometimes',
				    'nullable',
				    'string',
				    'min:1',
				    'max:256'
			    ];
		    }
	    }

	    foreach(['agree_terms', 'remember_me', 'password'] as $k) {
		    unset($rules[$k]);
	    }

	    if (!array_key_exists('address', $rules)) {
		    $rules['address'] = ['sometimes','array'];
			$temp =  [
				'address' => [
					'required',
					'string',
					'min:1',
					'max:256'
				],
				'city' => [
					'required',
					'string',
					'min:1',
					'max:256'
				],
				'state' => [
					'required',
					'string',
					'min:1',
					'max:256'
				],
				'postal_code' => [
					'required',
					'string',
					'min:1',
					'max:15'
				],
				'country_code' => [
					'required',
					'string',
					'min:1',
					'max:10'
				],
			];
		    foreach($temp as $k => $r) {
			    $x = array_search('required', $r);
			    if ($x !== false) {
				    $r[$x] = 'nullable';
				    $x = array_search('min:1', $r);
				    if ($x !== false) {
					    unset($r[$x]);
//			            $r[$x] = 'sometimes';
				    }
			    }
			    $rules['address.'.$k] = $r;
		    }
	    }

	    /**
	     * Find the unique rule for email, remove it.
	     * @deprecated
	     */
	    if (array_key_exists('email', $rules)) {
//            dd($rules['email']);
	    }

	    $validator = Validator::make($request->all(), $rules, [
		    // Message overrides.
	    ]);
	    $validator->validate();

	    $data = $validator->validated();

	    if (!array_key_exists('password', $data)) {
		    $data['password'] = '';
	    }

	    $address = array_filter($data['address']);
	    unset($data['address']);

	    $phone = array_intersect_key($data, array_flip(preg_grep('#^phone#', array_keys($data))));
	    $data = array_diff_key($data, $phone);

	    $class = get_class($user);

		$existing = $class::where('email',$data['email'])->take(1)->first();

		if (!$existing) {
			$existing = new $class($data);
			$existing->save();
		}

		if (!$office->clients()->where('user_id', $existing->getKey())->count()) {
			$office->clients()->attach($existing);
		}

		if ($request->wantsJson()) {
			return response()->json($existing);
		}

		return redirect()->route('clients.index');
    }
}
