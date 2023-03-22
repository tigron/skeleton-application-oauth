<?php
/**
 * Skeleton OAuth application
 */

namespace Skeleton\Application\Oauth;

use Skeleton\Application\Web\Template;

abstract class Handler extends \Skeleton\Application\Web\Module {

	/**
	 * League server instance
	 *
	 * @var \League\OAuth2\Server\AuthorizationServer
	 */
	protected $server;

	/**
	 * The server request as a PSR-7 ServerRequestInterface
	 *
	 * @var \Psr\Http\Message\ServerRequestInterface
	 */
	protected $server_request;

	/**
	 * Display function (not needed but required by the parent)
	 *
	 * @access public
	 */
	public function display() {}

	/**
	 * Accept the request
	 *
	 * @access public
	 */
	public function accept_request(): void {
		$template = Template::get();
		$template->assign('session', [
			'id' => session_id(),
		]);

		// initialise PSR-7 compatible request and response objects
		$this->server_request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

		$this->setup_oauth();

		if (method_exists($this, 'bootstrap') === true) {
			$this->bootstrap();
		}

		$response = $this->handle_request();


		if (method_exists($this, 'teardown') === true) {
			$this->teardown();
		}

		$this->emit_response($response);
	}

	/**
	 * Set up thephpleague/oauth2-server
	 *
	 * @access private
	 */
	private function setup_oauth() {
		$application = \Skeleton\Core\Application::get();

		$client_repository = new \Skeleton\Oauth\Repository\Client();
		$scope_repository = new \Skeleton\Oauth\Repository\Scope();
		$accesstoken_repository = new \Skeleton\Oauth\Repository\Accesstoken();
		$authcode_repository = new \Skeleton\Oauth\Repository\Authcode();
		$user_repository = new \Skeleton\Oauth\Repository\User();
		$refreshtoken_repository = new \Skeleton\Oauth\Repository\Refreshtoken();

		$this->server = new \League\OAuth2\Server\AuthorizationServer(
			$client_repository,
			$accesstoken_repository,
			$scope_repository,
			$application->config->oauth_private_key,
			\Defuse\Crypto\Key::loadFromAsciiSafeString(
				$application->config->oauth_encryption_key
			)
		);

		// set up authorization code grant
		$grant = new \League\OAuth2\Server\Grant\AuthCodeGrant(
			$authcode_repository,
			$refreshtoken_repository,
			new \DateInterval('PT10M') // expire authcodes after 10 minutes
		);

		$grant->setRefreshTokenTTL(new \DateInterval('PT4H')); // expire refresh tokens after 4 hours

		$this->server->enableGrantType(
			$grant,
			new \DateInterval('PT1H') // access tokens will expire after 1 hour
		);

		// set up password grant
		/*
		$grant = new \League\OAuth2\Server\Grant\PasswordGrant(
			$user_repository,
			$refreshtoken_repository,
			new \DateInterval('PT10M') // expire authcodes after 10 minutes
		);

		$grant->setRefreshTokenTTL(new \DateInterval('PT4H')); // expire refresh tokens after 4 hours

		$this->server->enableGrantType(
			$grant,
			new \DateInterval('PT1H') // access tokens will expire after 1 hour
		);
		*/

		// set up refresh token grant
		$grant = new \League\OAuth2\Server\Grant\RefreshTokenGrant($refreshtoken_repository);
		$grant->setRefreshTokenTTL(new \DateInterval('PT4H')); // expire refresh tokens after 4 hours

		$this->server->enableGrantType(
			$grant,
			new \DateInterval('PT1H') // access tokens will expire after 1 hour
		);
	}

	/**
	 * Simple PSR-7 emitter
	 *
	 * @param \Psr\Http\Message\ResponseInterface $response The response to emit
	 */
	private function emit_response(\Psr\Http\Message\ResponseInterface $response): void {
		$http_line = sprintf('HTTP/%s %s %s',
			$response->getProtocolVersion(),
			$response->getStatusCode(),
			$response->getReasonPhrase()
		);

		header($http_line, true, $response->getStatusCode());

		foreach ($response->getHeaders() as $name => $values) {
			foreach ($values as $value) {
				header("$name: $value", false);
			}
		}

		$stream = $response->getBody();

		if ($stream->isSeekable()) {
			$stream->rewind();
		}

		while (!$stream->eof()) {
			echo $stream->read(1024 * 8);
		}
	}
}
