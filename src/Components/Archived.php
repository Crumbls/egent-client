<?php

namespace Egent\Client\Components;


use App\Enum\UserClientStatuses;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\View\Component;

/**
 * @deprecated
 */
class Archived extends Component
{
	
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(public Model $user)
	{
	}

	public function shouldRender()
	{
		if (!$this->user || !$this->user->exists) {
			return false;
		}
		return true;
	}

	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		$request = request();
		$search = $request->get('search', '');
		$data = [
			'title' => __('Listings'),
			'entities' => $this->user->documents()
				->withoutGlobalScopes()
				->search($search)
				->whereIn('state', [\App\States\Document\Archived::class])
				->paginate()
				->withQueryString(),
			'search' => $search,
			'user' => $this->user
		];
		return view('client::components.archived', $data);
	}
}