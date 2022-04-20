<?php

namespace Egent\Client\Policies;

use App\Models\User;
use Egent\Office\Models\Office;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

	/**
	 * Can this user view their clients?
	 * @param User $user
	 * @return bool
	 */
	public function viewOwn(User $user) {
		return $user->isA('broker') || $user->isA('agent');
	}

	/**
	 * Determine whether the listing can view the model.
	 *
	 * @deprecated
	 * @param  App\Models\User  $user
	 * @param  App\Models\User $entity
	 * @return mixed
	 */
	public function view(User $user, User $entity)
	{
		return true;
		echo __METHOD__;
		exit;
		if ($user->offices->contains($entity)) {
			return true;
		}

		return false;
	}

	/**
	 * Can this user create a client?
	 * @param User $user
	 * @return bool
	 */
	public function create(User $user) {
		return $user->isA('broker') || $user->isA('agent');
	}

	/**
	 * Can this user update a client?
	 * TODO: Finish this to restrict to this user's data.
	 * @param User $user
	 * @return bool
	 */
	public function update(User $user) {
		return $user->isA('broker') || $user->isA('agent');
	}

}
