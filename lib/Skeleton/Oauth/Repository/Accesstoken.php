<?php
/**
 * Oauth Access Token Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class Accesstoken implements AccessTokenRepositoryInterface {

	/**
	 * Create a new access token
	 *
	 * @param ClientEntityInterface $clientEntity
	 * @param ScopeEntityInterface[] $scopes
	 * @param mixed $userIdentifier
	 *
	 * @return AccessTokenEntityInterface
	 */
	public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null) {
		$accessToken = new \Skeleton\Oauth\Entity\Accesstoken();
		$accessToken->setClient($clientEntity);

		foreach ($scopes as $scope) {
			$accessToken->addScope($scope);
		}

		$accessToken->setUserIdentifier($userIdentifier);

		return $accessToken;
	}

	/**
	 * Persists a new access token to permanent storage.
	 *
	 * @param AccessTokenEntityInterface $accessTokenEntity
	 *
	 * @throws UniqueTokenIdentifierConstraintViolationException
	 */
	public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity) {
		// call the Accesstoken component and store the token in the database
		// implementation of the called method should be optional
	}

	/**
	 * Revoke an access token.
	 *
	 * @param string $tokenId
	 */
	public function revokeAccessToken($tokenId) {
		// call the Accesstoken component and remove the token from the database
		// implementation of the called method should be optional
	}

	/**
	 * Check if the access token has been revoked.
	 *
	 * @param string $tokenId
	 *
	 * @return bool Return true if this token has been revoked
	 */
	public function isAccessTokenRevoked($tokenId) {
		// call the Accesstoken component and check the token status
		// implementation of the called method should be optional

		// return false so the token can always be used pending implementation
		return false;
	}
}
