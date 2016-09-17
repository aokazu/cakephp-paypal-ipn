<?php
namespace PaypalIpn\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventDispatcherTrait;
use Cake\Http\Client;
use Psr\Log\LogLevel;

/**
 * PaypalIpnRequest component
 */
class PaypalIpnRequestComponent extends Component
{

	protected $_defaultConfig = [
		'paypal_server' => 'https://www.sandbox.paypal.com',
		'event_base' => 'PayPal.IPN.'
	];

	/**
	 * Message types according to documentation https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNandPDTVariables/
	 * @var array
	 */
	protected $_known_events = [
		'adjustment',
		'cart',
		'express_checkout',
		'masspay',
		'merch_pmt',
		'mp_cancel',
		'mp_signup',
		'new_case',
		'payout',
		'pro_hosted',
		'recurring_payment',
		'recurring_payment_expired',
		'recurring_payment_failed',
		'recurring_payment_profile_cancel',
		'recurring_payment_profile_created',
		'recurring_payment_skipped',
		'recurring_payment_suspended',
		'recurring_payment_suspended_due_to_max_failed_payment',
		'send_money',
		'subscr_cancel',
		'subscr_eot',
		'subscr_failed',
		'subscr_modify',
		'subscr_payment',
		'subscr_signup',
		'virtual_terminal',
		'web_accept'
	];

	use EventDispatcherTrait;

	/**
	 * Dispatch a paypal event to listeners.
	 * @param $message
	 */
	public function dispatchEvent($message)
	{
		$message_type = $message['txn_type'];
		if (!in_array($message_type, $this->_known_events)) {
			$event_name = 'unknown';
		} else {
			$event_name = $this->config('event_base') . $message_type;
		}
		$event = new Event($event_name, $this, $message);
		$this->eventManager()->dispatch($event);
	}

	/**
	 * Send the object to paypal to check the data received.
	 * @param $data
	 * @return bool
	 */
	public function validate($data)
	{
		$data['cmd'] = '_notify-validate';
		$response = $this->queryPayPal($data);

		if ($response === false) {
			$this->log('The query of PayPal failed', LogLevel::ERROR, 'PayPal');
			return false;
		}

		if ($response['code'] != 200) {
			$this->log("The reponse code was '{$response['code']}' instead of 200", LogLevel::ERROR, 'PayPal');
			return false;
		}

		if ($response['body'] == 'INVALID') {
			$this->log("The reponse body was INVALID instead of VERIFIED", LogLevel::ERROR, 'PayPal');
			return false;
		} elseif ($response['body'] == 'VERIFIED') {
			return true;
		} else {
			$this->log("The body was unknown, response was: " . print_r($response, true), LogLevel::ERROR, 'PayPal');
			return false;
		}
	}

	/**
	 * Execute a query against Paypal.
	 * @param $data
	 * @return mixed
	 * @internal param $http
	 */
	public function queryPayPal($data)
	{

		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = [];

		foreach ($raw_post_array as $keyval) {
			$keyval = explode('=', $keyval);
			if (count($keyval) == 2) {
				if ($keyval[0] === 'payment_date') {
					if (substr_count($keyval[1], '+') === 1)
						$keyval[1] = str_replace('+', '%2B', $keyval[1]);
				}
				$myPost[$keyval[0]] = urldecode($keyval[1]);
			}
		}

		$req = 'cmd=_notify-validate';
		$get_magic_quotes_exists = false;
		if (function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}

		$paypal_url = $this->config('paypal_server') . '/cgi-bin/webscr';


		$ch = curl_init($paypal_url);
		if ($ch == false) {
			$this->log("Curl could not init", LogLevel::ERROR, 'PayPal');
			return false;
		}


		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);


		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: Close']);

		$res = curl_exec($ch);
		$info = curl_getinfo($ch);
		$http_code = $info['http_code'];

		if (!($res)) {
			$this->log("Curl Error: " . curl_error($ch), LogLevel::ERROR, 'PayPal');
			curl_close($ch);
			return false;
		}
		curl_close($ch);

		$this->log("PayPal Response: " . print_r(['body' => $res, 'code' => $http_code], true), LogLevel::INFO, 'PayPal');

		return ['body' => $res, 'code' => $http_code];
	}

}
