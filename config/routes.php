<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
	'PaypalIpn',
	['path' => '/paypal_ipn'],
	function (RouteBuilder $routes) {
		$routes->fallbacks('DashedRoute');
	}
);
