<?php
namespace Egent\Client\Controllers;

use App\Jobs\ImportOfficeByMlsId;
use App\Models\User;
use Egent\Office\Models\Office;
use Egent\Listing\Models\Property;
use App\Models\Role;
use App\Policies\OfficePolicy;
use App\Services\ReColorado\Manager;
use App\Services\ReColorado\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeStoreRequest;
use App\Http\Requests\OfficeUpdateRequest;
use Egent\Office\Controllers\AbstractController as Controller;

class DeleteController extends AbstractController
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Egent\Office\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
	    $user = \Auth::user();

	    $uuid = $request->client;
	    abort_if(!$uuid, 404);
	    abort_if(!\Str::isUuid($uuid), 404);

	    $client = User::clientOf($user)
		    ->where('users.uuid', $uuid)
		    ->take(1)
		    ->first();
		abort_if(!$client, 404);


	    return view('client::delete', [
			'user' => $user,
				'entity' => $client
            ]);
    }
}
