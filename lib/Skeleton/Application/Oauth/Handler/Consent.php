<?php
/**
 * Skeleton OAuth application
 */

namespace Skeleton\Application\Oauth\Handler;

use Skeleton\Application\Web\Template;
use Skeleton\Oauth\Repository\User;

class Consent extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$template = Template::get();

		$response = new \GuzzleHttp\Psr7\Response();
		$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

		if (!isset($_SESSION['auth_request'])) {
			return $response->withHeader('Location', '/error?type=invalid-auth-request')->withStatus(302);
		}

		$auth_request = $_SESSION['auth_request'];

		// TODO: ask User component if Client component already has Consent for Scopes
		// (might have been stored and saved somewhere already)

		// If we already have consent, authorize the token
		if ($auth_request->isAuthorizationApproved()) {
			return $response->withHeader('Location', '/authorize')->withStatus(302);
		}

		$body = $request->getParsedBody();

		if ($request->getMethod() === 'POST' && isset($body['consent'])) {
			if ($body['consent'] === 'approve') {
				$auth_request->setAuthorizationApproved(true);
				return $response->withHeader('Location', '/authorize')->withStatus(302);
			} else {
				session_destroy();
				return $response->withHeader('Location', '/error?type=consent-denied')->withStatus(302);
			}

			session_destroy();
			return $this->server->completeAuthorizationRequest($auth_request, $response);
		}

		$template->assign('client', $auth_request->getClient());
		$template->assign('scopes', $auth_request->getScopes());

		$response->getBody()->write($template->render('consent.twig'));
		return $response;
	}
}
