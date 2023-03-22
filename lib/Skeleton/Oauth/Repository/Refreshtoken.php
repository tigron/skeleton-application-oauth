<?php
/**
 * Oauth Refresh_Token Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class Refreshtoken implements RefreshTokenRepositoryInterface {

	/**
	 * Creates a new refresh token
	 *
	 * @return RefreshTokenEntityInterface|null
	 */
	public function getNewRefreshToken() {
		return new \Skeleton\Oauth\Entity\Refreshtoken();
	}

	/**
	 * Create a new refresh token_name.
	 *
	 * @param RefreshTokenEntityInterface $refreshTokenEntity
	 *
	 * @throws UniqueTokenIdentifierConstraintViolationException
	 */
	public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity) {
		// call the Refreshtoken component and store the token in the database
		// implementation of the called method should be optional
	}

	/**
	 * Revoke the refresh token.
	 *
	 * @param string $tokenId
	 */
	public function revokeRefreshToken($tokenId) {
		// call the Refreshtoken component and remove the token from the database
		// implementation of the called method should be optional
	}

	/**
	 * Check if the refresh token has been revoked.
	 *
	 * @param string $tokenId
	 *
	 * @return bool Return true if this token has been revoked
	 */
	public function isRefreshTokenRevoked($tokenId) {
		// call the Refreshtoken component and check the token status
		// implementation of the called method should be optional

		// return false so the token can always be used pending implementation
		return false;
	}
}
