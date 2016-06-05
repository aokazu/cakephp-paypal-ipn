# Paypal IPN
* Version 1.0.0
* Author: Dominik Schmelz

# Required:
CakePHP 3.0

# CHANGELOG:
* 1.0: Initial release

# Install:
1. Add `otoso/cakephp-paypal-ipn` to your `composer.json` and execute `composer update`
2. Load the plugin in `bootstrap.php`

		Plugin::load('PaypalIpn');

2. Run the migration to create the required tables.
 