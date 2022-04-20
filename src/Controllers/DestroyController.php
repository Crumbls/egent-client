<?php

namespace Egent\Client\Controllers;

use App\Jobs\ImportOfficeByMlsId;
use App\Models\User;
use App\Models\UserClient;
use Egent\Office\Models\Office;
use Egent\Listing\Models\Property;
use App\Models\Role;
use App\Policies\OfficePolicy;
use App\Services\ReColorado\Manager;
use App\Services\ReColorado\Member;
use Egent\Office\Models\OfficeClient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeStoreRequest;
use App\Http\Requests\OfficeUpdateRequest;
use Egent\Office\Controllers\AbstractController as Controller;

/**
 * Destroy.
 */
class DestroyController extends DeleteController
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

		// Delete their direct relation.
		$pivot = UserClient::where('user_id', $user->getKey())->where('client_id', $client->getKey())->take(1)->first();
		if ($pivot) {
			$pivot->delete();
		}

		/**
		 * Determine if any other users in this office has this user as a client.
		 * If they do not, delete them.
		 */
		foreach($user->offices as $office) {
			$count = $office->users()
				->whereIn('users.id',
					UserClient::where('client_id', $client->getKey())
						->select('user_id')
				)
				->count();
			if (!$count) {
				/**
				 * Disconnect them from this office.
				 * TODO: In the future, split these out so we can listen with an observer.
				 */
				$office->clients()->where('user_id',$client->getKey())->delete();
			}
		}

		if ($request->wantsJson()) {
			return response()->json([]);
		}

		flash('success', __('Client Removed'));

		return redirect()->route('clients.index');
	}
}
