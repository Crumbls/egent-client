<?php

namespace Egent\Client\Components;


use App\Enum\UserClientStatuses;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\View\Component;

class Listings extends Component
{
//	private $status;
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(public Model $user)
	{
		if (!$this->user || !$this->user->exists) {
			$this->user = \Auth::user();
		}
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
			'entities' => $this->user->listings()
//				->wherePivotIn('status', $this->status)
				->search($search)
				->latest()
				->paginate()
				->withQueryString(),
			'search' => $search,
			'user' => $this->user
		];
		return view('client::components.listings', $data);
	}
}