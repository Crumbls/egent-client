<?php

namespace Egent\Client\Components;


use App\Enum\UserClientStatuses;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\View\Component;

class Notifications extends Component
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

		echo __METHOD__;
		return;
		$data = [
			'title' => __('Upcoming Deadlines'),
			'user' => $this->user,
			'entities' => $this->user->deadlines()->where('due_at','>=',now())->paginate()
		];
		return view('client::components.deadline-upcoming', $data);
	}
}