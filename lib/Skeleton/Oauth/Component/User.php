<?php
/**
 * Oauth Component Interface User
 */

namespace Skeleton\Oauth\Component;

abstract class User extends \Skeleton\Oauth\Entity\User {

	/**
	 * Shim between skeleton and league
	 * Return the user's identifier
	 *
	 * @return string
	 */
	public function getIdentifier() {
		return $this->get_login();
	}

	/**
	 * Get the user's login (username, email, ...). This will be the identifier.
	 *
	 * @return string
	 */
	abstract public function get_login(): string;

	/**
	 * Authentication of the user. Should thrown an exception if it fails or
	 * return an object implementing the User object.
	 *
	 * @throws \Skeleton\Oauth\Exception\Authentication\Failed()
	 */
	abstract public static function authenticate(string $login, string $password, string $grant_type, \Skeleton\Oauth\Entity\Client $client): User;

	/**
	 * Search for a user by their login. Should thrown an exception if it fails or
	 * return an object implementing the User object.
	 *
	 * @throws \Skeleton\Oauth\Exception\Authentication\Failed()
	 */
	abstract public static function get_by_login(string $login): User;
}