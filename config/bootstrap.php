<?php
use Cake\Core\Configure;

if (!Configure::check('PayPalIpn')) {
	Configure::load('PaypalIpn.paypal_ipn');
}
