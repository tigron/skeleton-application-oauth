<?php
/**
 * Skeleton OAuth application: /accesstoken handler
 */

namespace Skeleton\Application\Oauth\Handler;

class Accesstoken extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$response = new \GuzzleHttp\Psr7\Response();
		$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

		return $this->server->respondToAccessTokenRequest($this->server_request, $response);
	}
}
