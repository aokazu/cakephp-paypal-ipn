# Paypal IPN
[![Build Status](https://api.travis-ci.org/otoso/cakephp-paypal-ipn.svg?branch=master)](https://travis-ci.org/otoso/cakephp-paypal-ipn)
* Version 1.0.0
* Author: DIDoS @ Otoso (https://www.otoso.net)
* Author: daniel_san @ Otoso (https://www.otoso.net)
* See Authors of used code in chapter Thanks

# License
* MIT License (MIT)
* See LICENSE file for more details

# Requirements
* CakePHP 3.x
* php_openssl (optional but recommended)

# Verionlog
* 1.0: Initial release

# Install
1. Add `otoso/cakephp-paypal-ipn` to your `composer.json` and execute `composer update`
2. Load the plugin in `bootstrap.php`

		Plugin::load('PaypalIpn', ['routes' => true]);

2. Run the migration to create the required tables.

		cake Migrations migrate -p PaypalIpn


# Usage

## Helper
The Helper is used to create a paypal button/form (e.g. "Buy Now" or "Checkout"). To create a form in a view you simply add the helper to your Controller:

		public $helpers = ['PaypalIpn.Paypal'];

Then you can use the Paypal Helper in your view like this:

		echo $this->Paypal->button(__('Pay Now'), [
        	'test' => $paypal_sandbox,
            'amount' => $total_amount_gross,
            'currency_code' => $costs_currency,
            'item_name' => $item_name,
        	'business' => $costs_paypal_email,
            'custom' => $payment_id,
            'notify_url'    => Router::url('/paypal_ipn/process',true),
            'return' => Router::url("/payments/paypalSuccess", true)
        ], [
            "type"=>"image",
            "src"=>"https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
        ]);



## IPN

Paypal will send an Instant Payment Notification (IPN) to the notify_url (given in the configuration) and the plugin will verify the IPN.
After the verification it will dispatch an Event according to the result of the payment. Possible events (with the standard event_base configuration) are:


		PayPal.IPN.adjustment
		PayPal.IPN.cart
		PayPal.IPN.express_checkout
		PayPal.IPN.masspay
		PayPal.IPN.merch_pmt
		PayPal.IPN.mp_cancel
		PayPal.IPN.mp_signup
		PayPal.IPN.new_case
		PayPal.IPN.payout
		PayPal.IPN.pro_hosted
		PayPal.IPN.recurring_payment
		PayPal.IPN.recurring_payment_expired
		PayPal.IPN.recurring_payment_failed
		PayPal.IPN.recurring_payment_profile_cancel
		PayPal.IPN.recurring_payment_profile_created
		PayPal.IPN.recurring_payment_skipped
		PayPal.IPN.recurring_payment_suspended
		PayPal.IPN.recurring_payment_suspended_due_to_max_failed_payment
		PayPal.IPN.send_money
		PayPal.IPN.subscr_cancel
		PayPal.IPN.subscr_eot
		PayPal.IPN.subscr_failed
		PayPal.IPN.subscr_modify
		PayPal.IPN.subscr_payment
		PayPal.IPN.subscr_signup
		PayPal.IPN.virtual_terminal
		PayPal.IPN.web_accept

Details regarding the meaning of the different messages can be found in the PayPal documentation (https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNandPDTVariables).

# Encryption




# Thanks
* Thanks to Webtechnik for the awesome cake 2.x plugin which was used to create this plugin https://github.com/webtechnick/CakePHP-Paypal-IPN-Plugin
* Thanks to Ivor Durham and PayPal_Ahmad for the PayPalEWP class which allows us to encrypt the buttons without shell executes https://github.com/josephholsten/swaplady/blob/master/library/PaypalEwp.php
