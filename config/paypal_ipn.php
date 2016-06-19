<?php
return [
	'PayPalIpn' => [ //General configurations. All of it can be overwritten by Hepler Config or options on the button call
		'test_mode' => true, //override to set all buttons in test mode
		'prod' => [ //configuration for real buttons
			'business' => 'live_email@paypal.com',    //Your Paypal email account
			'paypal_server' => 'https://www.paypal.com',    //Paypal server
			'notify_url' => 'http://yoursite.com/paypal_ipn/process',    //The url that paypal is supposed to call
			'currency_code' => 'EUR',    // ISO 4217 Currency
			'lc' => 'DE',               // Locality
			'encrypt' => [
				'cert_id' => '',                              // Certificate ID (gotten after certificate uploaded to paypal)
				'key_file' => '',                              // Absolute path to Private Key File
				'cert_file' => '',                              // Absolute path to Public Certificate file
				'paypal_cert_file' => '',                           // Absolute path to Paypal certificate file
				'openssl' => '/usr/bin/openssl',              // OpenSSL location
				'bn' => 'cakephp_paypal-ipn',     // Build Notation
			]
		],
		'test' => [ //configuration for test buttons
			'business' => 'test@paypal.com',    //Your Paypal email account
			'paypal_server' => 'https://www.sandbox.paypal.com',    //Paypal server
			'notify_url' => 'http://yoursite.com/paypal_ipn/process',    //The url that paypal is supposed to call
			'currency_code' => 'EUR',    // ISO 4217 Currency
			'lc' => 'DE',               // Locality
			'encrypt' => false,       // Set to true to enable encryption
		],

	]
];
