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
	 * Get the user's firstname
	 *
	 * Potentially not needed in the end (would have been necessary for openid).
	 *
	 * @return string
	 */
	abstract public function get_firstname(): string;

	/**
	 * Get the user's lastname
	 *
	 * Potentially not needed in the end (would have been necessary for openid).
	 *
	 * @return string
	 */
	abstract public function get_lastname(): string;

	/**
	 * Authentication of the user. Should thrown an exception if it fails or
	 * return an object implementing the User object.
	 *
	 * @throws \Skeleton\Oauth\Exception\Authentication\Failed()
	 */
	abstract public static function authenticate(string $login, string $password, string $grant_type, \Skeleton\Oauth\Entity\Client $client): User;
}
