<?php
/**
 * Skeleton OAuth component shim
 */

namespace Skeleton\Application\Oauth;

class Component {

	/**
	 * Look for a component in the application space
	 *
	 * @param string $name The name of the component to search
	 * @return object An object implementing the requested component
	 */
	public static function get(string $name): object {
		$application = \Skeleton\Core\Application::get();
		return new $application->component_namespace . ucfirst($name);
	}

	/**
	 * Get the classname within the application for a given component
	 *
	 * @param string $name The name of the component to search
	 * @return string The component's classname
	 */
	public static function get_classname(string $name): string {
		$application = \Skeleton\Core\Application::get();
		return $application->component_namespace . ucfirst($name);
	}
}
