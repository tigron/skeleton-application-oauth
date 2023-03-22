<?php
/**
 * Skeleton OAuth application
 */

namespace Skeleton\Application\Oauth\Handler;

use Skeleton\Application\Web\Template;

class Error extends \Skeleton\Application\Oauth\Handler {

	/**
	 * Handle the request
	 *
	 * @access public
	 */
	public function handle_request() {
		$response = new \GuzzleHttp\Psr7\Response();
		$template = Template::get();

		$request_query = $this->server_request->getQueryParams();

		if (isset($request_query['type'])) {
			$template->assign('type', $request_query['type']);
		}

		$response->getBody()->write($template->render('error.twig'));
		return $response;
	}
}
