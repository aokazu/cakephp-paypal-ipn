<?php
use Cake\Core\Configure;

if (!Configure::check('PayPalIpn')) {
	Configure::load('PayPalIpn.paypal_ipn');
}
