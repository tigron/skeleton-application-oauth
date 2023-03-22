<?php
/**
 * Oauth Auth_Code Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class Authcode implements AuthCodeEntityInterface {
	use EntityTrait, TokenEntityTrait, AuthCodeTrait;
}
