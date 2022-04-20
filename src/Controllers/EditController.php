<?php

namespace Egent\Client\Controllers;

use App\Enum\Countries;
use App\Models\User;
use Egent\Office\Models\OfficeClient;
use Illuminate\Http\Request;

class EditController extends AbstractController
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

		$client = User::where(function($sub) use ($user) {
			$sub->whereIn('users.id', $user->clients()->select('users.id'));
			if ($offices = $user->offices->pluck('id')->toArray()) {
				$sub->orWhereIn('users.id', OfficeClient::whereIn('office_id', $offices)->select('user_id'));
			}
		})
			->where('users.uuid', $uuid)
			->take(1)
			->first();

		abort_if(!$client, 404);

		return view('client::edit', [
			'user' => $user,
			'entity' => $client,
			'policy' => $this->getPolicy(),
			'countries' => Countries::toArray(),
		]);
	}
}
