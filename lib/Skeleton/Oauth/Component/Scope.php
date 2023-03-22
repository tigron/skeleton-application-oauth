<?php
/**
 * Oauth Component Interface Scope
 */

namespace Skeleton\Oauth\Component;

abstract class Scope extends \Skeleton\Oauth\Entity\Scope {

	/**
	 * Shim between skeleton and league
	 * Return the scope identifier
	 *
	 * @return string
	 */
	public function getIdentifier() {
		return $this->get_identifier();
	}

	/**
	 * Get the scope identifier
	 *
	 * @return string
	 */
	abstract public function get_identifier(): string;

	/**
	 * Get the scope description
	 *
	 * @return string
	 */
	abstract public function get_description(): string;

	/**
	 * Get all available scopes
	 *
	 * @return Scope[]
	 */
	abstract public static function get_all(): array;

	/**
	 * Get a scope by identifier
	 *
	 * @param string
	 * @return Scope
	 */
	abstract public static function get_by_identifier(string $identifier): self;
}
