<?php
/**
 * User Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class User implements UserRepositoryInterface {

	/**
	 * Get a user entity
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $grantType The grant type used
	 * @param ClientEntityInterface $clientEntity
	 *
	 * @return UserEntityInterface|null
	 */
	public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity): ?\Skeleton\Oauth\Entity\User {
		$component = \Skeleton\Application\Oauth\Component::get_classname('User');

		try {
			$user_component = $component::authenticate($username, $password, $grantType, $clientEntity);
		} catch (\Skeleton\Oauth\Exception\Authentication\Failed $e) {
			return null;
		}

		return $user_component;
	}
}
