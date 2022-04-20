<?php
namespace Egent\Client\Controllers;

use App\Enum\Countries;
use App\Enum\States;
use Illuminate\Http\Request;

class CreateController extends AbstractController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = \Auth::user();

	    $policy = $this->getPolicy();
		abort_if(!$policy->create($user), 403);

        return view('client::create', [
			'user' => $user,
			'policy' => $policy,
			'countries' => Countries::toArray(),
			'states' => States::toArray()
	        ]);
    }
}
