<?php
/**
 * Oauth Client Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class Client implements ClientEntityInterface {
	use EntityTrait, ClientTrait;

	/**
	 * Set a client's name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Set a client's redirect URI
	 *
	 * @param string $uri
	 */
	public function setRedirectUri($uri) {
		$this->redirectUri = $uri;
	}

	/**
	 * Mark a client as confidential
	 *
	 * @param string $name
	 */
	public function setConfidential() {
		$this->isConfidential = true;
	}
}
