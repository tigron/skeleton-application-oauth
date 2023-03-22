<?php
/**
 * Oauth Component Client
 */

namespace Skeleton\Oauth\Component;

abstract class Client extends \Skeleton\Oauth\Entity\Client {

	/**
	 * Get the client's identifier
	 *
	 * @return string
	 */
	abstract public function get_identifier(): string;

	/**
	 * Get the client's name
	 *
	 * @return string
	 */
	abstract public function get_name(): string;

	/**
	 * Get the client's secret
	 *
	 * @return string
	 */
	abstract public function get_secret(): string;

	/**
	 * Get the client's redirect URI
	 *
	 * @return string
	 */
	abstract public function get_redirect_uri(): string;

	/**
	 * Check if the client is confidential
	 *
	 * @return bool
	 */
	abstract public function is_confidential(): bool;

	/**
	 * Get all available clients
	 *
	 * @return Client[]
	 */
	abstract public static function get_all(): array;


	/**
	 * Get a client by identifier
	 *
	 * @param string
	 * @return Client
	 */
	abstract public static function get_by_identifier(string $identifier): self;
}
