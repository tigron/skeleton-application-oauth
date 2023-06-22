<?php
/**
 * Oauth events
 */

namespace Skeleton\Application\Oauth\Event;

class Oauth extends \Skeleton\Core\Application\Event {

	/**
	 * User authentication was successful
	 *
	 * @access public
	 */
	public function user_authentication_success($authentication_request): void {
		// Create audit trail
	}

	/**
	 * User two-factor authentication was successful
	 *
	 * @access public
	 */
	public function user_tfa_success($authentication_request): void {
		// Create audit trail
	}
}