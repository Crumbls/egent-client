<?php

namespace Egent\Client\Controllers;

use Egent\Client\Policies\ClientPolicy;
use Egent\Office\Controllers\AbstractController as BaseController;

abstract class AbstractController extends BaseController
{
	private $_policy;

	public function getPolicy() {
		if ($this->_policy) {
			return $this->_policy;
		}
		$policy = \Config::get('client.policy', ClientPolicy::class);
		$this->_policy = new $policy();
		return $this->_policy;
	}

}
