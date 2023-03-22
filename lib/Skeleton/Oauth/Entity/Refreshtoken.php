<?php
/**
 * Oauth Client Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;

class Refreshtoken implements RefreshTokenEntityInterface {
	use RefreshTokenTrait, EntityTrait;
}
