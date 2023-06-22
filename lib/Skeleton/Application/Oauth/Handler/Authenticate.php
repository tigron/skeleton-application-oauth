<?php
/**
 * Skeleton OAuth application: /authenticate handler
 */

namespace Skeleton\Application\Oauth\Handler;

use Skeleton\Application\Web\Template;
use Skeleton\Oauth\Repository\User;

class Authenticate extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$application = \Skeleton\Core\Application::get();
		$template = Template::get();

		$response = new \GuzzleHttp\Psr7\Response();
		$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

		if ($request->getMethod() === 'POST') {
			// Default to failed authentication and no claim about tfa
			$json_response = [
				'authentication_timeout' => false,
				'authentication_successful' => false,
				'tfa_required' => null,
				'tfa_successful' => null,
			];

			// If we lost the session somehow, we need to ask the user to stop
			// and start over (user let the browser open for too long)
			if (!isset($_SESSION['auth_request'])) {
				$json_response['authentication_timeout'] = true;

				$response->getBody()->write(json_encode($json_response));
				return $response;
			}

			// Default to no user found
			$user = null;

			$body = json_decode($request->getBody(), true);

			if (!empty($body['username']) && !empty($body['password']) && isset($body['tfa_code'])) {
				$auth_request = $_SESSION['auth_request'];

				// This method returns a UserEntityInterface or null on failure
				$user = new User();
				$user = $user->getUserEntityByUserCredentials($body['username'], $body['password'], $auth_request->getGrantTypeId(), $auth_request->getClient());
			}

			if ($user !== null) {
				$application->call_event_if_exists('oauth', 'user_authentication_success', [$auth_request]);
				$auth_request->setUser($user);
				$json_response['authentication_successful'] = true;

				if ($user->has_tfa()) {
					$json_response['tfa_required'] = true;
				} else {
					$json_response['tfa_required'] = false;
				}
			}

			if ($json_response['tfa_required'] === true && !empty($body['tfa_code'])) {
				$json_response['tfa_successful'] = $user->verify_tfa($body['tfa_code']);
			}

			if ($json_response['tfa_successful']) {
				$application->call_event_if_exists('oauth', 'user_tfa_success', [$auth_request]);
			}

			$response->getBody()->write(json_encode($json_response));
			return $response;
		}

		$response->getBody()->write($template->render('login.twig'));
		return $response;
	}
}
