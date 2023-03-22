<?php
/**
 * Oauth Scope Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\ScopeTrait;

class Scope implements ScopeEntityInterface {
	use EntityTrait, ScopeTrait;

	/**
	 * Return the scope's identifier
	 *
	 * @return mixed
	 */
	public function getIdentifier() {
		return $this->identifier;
	}
}
