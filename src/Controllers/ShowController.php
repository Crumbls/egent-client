<?php

namespace Egent\Client\Controllers;

use App\Models\User;
use Egent\Office\Models\Office;
use Egent\Office\Controllers\AbstractController as Controller;
use Egent\Office\Models\OfficeClient;
use Illuminate\Http\Request;

class ShowController extends AbstractController
{
	/**
	 * @param \Illuminate\Http\Request $request
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

		return view('client::show', [
			'user' => $user,
			'entity' => $client,
			'policy' => $this->getPolicy()
		]);
	}
}
