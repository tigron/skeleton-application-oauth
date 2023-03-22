<?php
/**
 * Oauth Access_Token Entity
 */

namespace Skeleton\Oauth\Entity;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class Accesstoken implements AccessTokenEntityInterface {
	use AccessTokenTrait, TokenEntityTrait, EntityTrait;
}