<?php
/**
 * Oauth USer Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\UserEntityInterface;

class User implements UserEntityInterface {
	/**
	 * @var string
	 */
	private $identifier;

	/**
	 * Return the user's identifier
	 *
	 * @return mixed
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Set a user's identifier
	 *
	 * @param string $identifier
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}
}
