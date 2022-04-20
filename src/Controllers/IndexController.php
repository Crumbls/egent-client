<?php

namespace Egent\Client\Controllers;

use App\Models\User;
use Egent\Office\Models\OfficeClient;
use Illuminate\Http\Request;

class IndexController extends AbstractController
{
	/**
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request)
	{
		$user = \Auth::user();

		/**
		 * This is an ugly work around, but it works for now.
		 */
		$policy = $this->getPolicy();
		abort_if(!$policy->viewOwn($user), 403);

		return view('client::index', [
			'user' => $user,
//			'entities' => $entities,
			'policy' => $policy
		]);
	}
}
