<?php
/**
 * Oauth Scope Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class Scope implements ScopeRepositoryInterface {

	/**
	 * Return information about a scope
	 *
	 * @param string $identifier The scope identifier
	 *
	 * @return ScopeEntityInterface|null
	 */
	public function getScopeEntityByIdentifier($scopeIdentifier) {
		$component = \Skeleton\Application\Oauth\Component::get_classname('Scope');

		// This can potentially throw an exception if the client requested an
		// unknown scope; not sure how common this is and if this should be
		// handled more gracefully. League expects a null return.
		try {
			$component::get_by_identifier($scopeIdentifier);
		} catch (\Exception $e) {
			return null;
		}

		$scope = new $component();
		$scope->setIdentifier($scopeIdentifier);

		return $scope;
	}

	/**
	 * Final validation of all components
	 *
	 * @param ScopeEntityInterface[] $scopes
	 * @param string $grantType
	 * @param ClientEntityInterface $clientEntity
	 * @param null|string $userIdentifier
	 *
	 * @return ScopeEntityInterface[]
	*/
	public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null): array {
		// This is where the combination of client, user, grant type and scope
		// can be validated. Currently not relevant and not implemented.

		return $scopes;
	}
}
