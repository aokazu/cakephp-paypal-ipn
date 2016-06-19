<?php
namespace PaypalIpn\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventDispatcherTrait;
use Cake\Network\Http\Client;
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
	 * Send the object to paypal to check the
	 */
	public function validate($data)
	{
		$data['cmd'] = '_notify-validate';
		$response = $this->queryPayPal($data);

		if ($response->code == 200) {
			$this->log(LogLevel::ERROR, "The reponse code was '{$response->code}' instead of 200", 'PayPal');
			return false;
		}

		if ($response->body == 'INVALID') {
			$this->log(LogLevel::ERROR, "The reponse body was INVALID instead of VERIFIED", 'PayPal');
			return false;
		} elseif ($response->body == 'VERIFIED') {
			return true;
		} else {
			$this->log(LogLevel::ERROR, "The body was unknown: {$response->body}", 'PayPal');
			return false;
		}
	}

	/**
	 * @param $data
	 * @return mixed
	 * @internal param $http
	 */
	public function queryPayPal($data)
	{
		$this->_defaultConfig;
		$http = new Client();
		$response = $http->get($this->config('paypal_server') . '/cgi-bin/webscr', $data);
		return $response;
	}


}
