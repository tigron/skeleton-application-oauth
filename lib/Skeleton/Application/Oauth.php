<?php
/**
 * Skeleton OAuth application
 */

namespace Skeleton\Application;

use \Skeleton\Core\Http\Session;
use \Skeleton\Core\Http\Media;

class Oauth extends \Skeleton\Application\web {

	/**
	 * Get details
	 *
	 * @access protected
	 */
	protected function get_details(): void {
		parent::get_details();

		$this->component_path = $this->path . '/component/';
		$this->component_namespace = "\\App\\" . ucfirst($this->name) . "\Component\\";

		$autoloader = new \Skeleton\Core\Autoloader();
		$autoloader->add_namespace($this->component_namespace, $this->component_path);
		$autoloader->register();
	}

	/**
	 * Load the config
	 *
	 * @access private
	 */
	protected function load_config(): void {
		parent::load_config();
		$this->config->route_resolver = null;
	}

	/**
	 * Get events
	 *
	 * Get a list of events for this application.
	 * The returned array has the context as key, the value is the classname
	 * of the default event
	 *
	 * @access protected
	 * @return array $events
	 */
	protected function get_events(): array {
		return array_merge(parent::get_events(), [
			'Oauth' => '\\Skeleton\\Application\\Oauth\\Event\\Oauth',
		]);
	}

	/**
	 * Run the application
	 *
	 * @access public
	 */
	public function run(): void {
		session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]);
		parent::run();
	}

	/**
	 * Search the appropriate handler
	 *
	 * @access public
	 * @param string $request_uri
	 */
	public function route($request_uri): \Skeleton\Application\Oauth\Handler {
		$server_request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

		if ($server_request->getUri()->getPath() == '/authorize') {
			return new \Skeleton\Application\Oauth\Handler\Authorize();
		} elseif ($server_request->getUri()->getPath() == '/authenticate') {
			return new \Skeleton\Application\Oauth\Handler\Authenticate();
		} elseif ($server_request->getUri()->getPath() == '/consent') {
			return new \Skeleton\Application\Oauth\Handler\Consent();
		} elseif ($server_request->getUri()->getPath() == '/accesstoken') {
			return new \Skeleton\Application\Oauth\Handler\Accesstoken();
		} elseif ($server_request->getUri()->getPath() == '/error') {
			return new \Skeleton\Application\Oauth\Handler\Error();
		}

		return new \Skeleton\Application\Oauth\Handler\Undefined();
	}
}
