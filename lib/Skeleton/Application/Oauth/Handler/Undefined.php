<?php
/**
 * Skeleton OAuth application
 */

namespace Skeleton\Application\Oauth\Handler;

class Undefined extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$response = new \GuzzleHttp\Psr7\Response();
		$response->getBody()->write('request not handled');
		return $response;
	}
}
