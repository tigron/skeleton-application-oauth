<?php
/**
 * Skeleton OAuth application: /authorize handler
 */

namespace Skeleton\Application\Oauth\Handler;

class Authorize extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$response = new \GuzzleHttp\Psr7\Response();

		$query_params = $this->server_request->getQueryParams();

		// basic validation of the request
		/*
		if (!isset($query_params['response_type']) || $query_params['response_type'] !== 'code' || !isset($query_params['client_id'])) {
			// we should probably call an event here
			throw new \Skeleton\Oauth\Exception\Request\Invalid();
		}
		*/

		if (!isset($_SESSION['auth_request'])) {
			$_SESSION['auth_request'] = $this->server->validateAuthorizationRequest($this->server_request);
			return $response->withHeader('Location', '/authenticate')->withStatus(302);
		}

		$auth_request = $_SESSION['auth_request'];

		if ($auth_request->getUser() === null) {
			// This shouldn't happen, but setUser can only be done there
			return $response->withHeader('Location', '/authenticate')->withStatus(302);
		}

		$auth_request->getUser();

		if (!$auth_request->isAuthorizationApproved()) {
			return $response->withHeader('Location', '/consent')->withStatus(302);
		}

		unset($_SESSION['auth_request']);

		return $this->server->completeAuthorizationRequest($auth_request, $response);
	}
}
