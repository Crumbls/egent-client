<?php

namespace Egent\Client\Components;


use App\Enum\UserClientStatuses;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\View\Component;

class Contracts extends Component
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
		$data = $this->extractPublicProperties();
		$data = array_merge($data, [
			'title' => __('Drafts'),
			'entities' => $this->user->documents()
				->withoutGlobalScopes()
				->search($search)
				->whereNotIn('state', [\App\States\Document\Archived::class,\App\States\Document\Draft::class])
				->paginate()
				->withQueryString(),
			'search' => $search,
		]);
		return view('client::components.contracts', $data);
	}
}