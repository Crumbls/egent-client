<?php

namespace Egent\Client\Components;


use App\Enum\UserClientStatuses;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\View\Component;

/**
 * @deprecated
 */
class Documents extends Component
{
	
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct(public Model $user, public $entities)
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
		$data = $this->extractPublicProperties();
		return view('client::components.documents', $data);
	}
}