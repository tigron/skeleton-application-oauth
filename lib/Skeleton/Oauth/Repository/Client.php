<?php
/**
 * Oauth Client Repository
 */

namespace Skeleton\Oauth\Repository;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class Client implements ClientRepositoryInterface {

	/**
	 * Get a client.
	 *
	 * @param string $clientIdentifier The client's identifier
	 *
	 * @return ClientEntityInterface|null
	 */
	public function getClientEntity($client_identifier) {
		$component = \Skeleton\Application\Oauth\Component::get_classname('Client');

		$client = $component::get_by_identifier($client_identifier);

		$client->setIdentifier($client->get_identifier());
		$client->setName($client->get_name());
		$client->setRedirectUri($client->get_redirect_uri());

		if ($client->is_confidential()) {
			$client->setConfidential();
		}

		return $client;
	}

	/**
	 * Validate a client's secret.
	 *
	 * @param string $clientIdentifier The client's identifier
	 * @param null|string $clientSecret The client's secret (if sent)
	 * @param null|string $grantType The type of grant the client is using (if sent)
	 *
	 * @return bool
	 */
	public function validateClient($client_identifier, $client_secret, $grant_type) {
		$component = \Skeleton\Application\Oauth\Component::get_classname('Client');

		try {
			$client_component = $component::get_by_identifier($client_identifier);
		} catch (\Exception $e) {
			return false;
		}

		if ($client_component->is_confidential() === true && \password_verify($client_secret, $client_component->get_secret()) === false) {
			return false;
		}

		return true;
	}
}
