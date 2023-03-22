<?php
/**
 * Oauth Auth_Code Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class Authcode implements AuthCodeRepositoryInterface {

	/**
	 * Creates a new AuthCode
	 *
	 * @return AuthCodeEntityInterface
	 */
	public function getNewAuthCode() {
		return new \Skeleton\Oauth\Entity\Authcode();
	}

	/**
	 * Persists a new auth code to permanent storage.
	 *
	 * @param AuthCodeEntityInterface $authCodeEntity
	 *
	 * @throws UniqueTokenIdentifierConstraintViolationException
	 */
	public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity) {
		// call the Authcode component and store the token in the database
		// implementation of the called method should be optional
	}

	/**
	 * Revoke an auth code.
	 *
	 * @param string $codeId
	 */
	public function revokeAuthCode($codeId) {
		// call the Authcode component and remove the token from the database
		// implementation of the called method should be optional
	}

	/**
	 * Check if the auth code has been revoked.
	 *
	 * @param string $codeId
	 *
	 * @return bool Return true if this code has been revoked
	 */
	public function isAuthCodeRevoked($codeId) {
		// call the Authcode component and check the token status
		// implementation of the called method should be optional

		// return false so the token can always be used pending implementation
		return false;
	}
}
