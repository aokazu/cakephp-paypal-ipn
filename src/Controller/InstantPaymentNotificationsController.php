<?php
namespace PaypalIpn\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Log\LogTrait;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;
use PaypalIpn\Controller\Component\PaypalIpnRequestComponent;
use PaypalIpn\Model\Entity\InstantPaymentNotification;
use PDOException;
use Psr\Log\LogLevel;


/**
 * InstantPaymentNotifications Controller
 *
 * @property \PaypalIpn\Model\Table\InstantPaymentNotificationsTable $InstantPaymentNotifications
 * @property InstantPaymentNotification InstantPaymentNotification
 * @property PaypalIpnRequestComponent PaypalIpnRequest
 */
class InstantPaymentNotificationsController extends Controller
{

	use LogTrait;

	public $helpers = array('Html', 'Form');

	public function initialize()
	{
		parent::initialize();
		$this->loadModel('PaypalIpn.InstantPaymentNotifications');

		$local_config = Configure::read('PayPalIpn.test_mode') ? Configure::read('PayPalIpn.test') : Configure::read('PayPalIpn.prod');
		$this->loadComponent('PaypalIpn.PaypalIpnRequest', $local_config);
	}

	/**
	 * @param Event $event
	 * @return \Cake\Network\Response|null|void
	 */
	public function beforeFilter(Event $event)
	{
		if (isset($this->Auth)) {
			$this->Auth->allow('process');
		}
	}

	/**
	 * Paypal IPN processing
	 */
	public function process()
	{
		$this->autoRender = false;
		if ($this->PaypalIpnRequest->validate($this->request->data)) {
			$instantPaymentNotification = $this->request->data;
			if (!is_int($this->request->data('num_cart_items')) && $this->request->data('num_cart_items') > 0) {
				for ($i = 1; $i <= $this->request->data('num_cart_items'); $i++) {
					$item = [];
					$item['item_name'] = $this->request->data("item_name{$i}");
					$item['item_number'] = $this->request->data("item_number{$i}");
					$item['quantity'] = $this->request->data("quantity{$i}");
					$item['mc_shipping'] = $this->request->data("mc_shipping{$i}");
					$item['mc_handling'] = $this->request->data("mc_handling{$i}");
					$item['mc_gross'] = $this->request->data("mc_gross_{$i}");
					$item['tax'] = $this->request->data("tax{$i}");
					$instantPaymentNotification['paypal_items'][] = $item;
				}
			}

			$this->utf8_encode_deep($instantPaymentNotification);

			$ipn_entity = $this->InstantPaymentNotifications->newEntity($instantPaymentNotification);

			$ipn_save_result = false;
			try {
				$ipn_save_result = $this->InstantPaymentNotifications->save($ipn_entity);
			} catch (PDOException $ex) {
				$this->log('Fatal PDO Exception. Request was: ' . var_export($this->request->data(), true));
				throw $ex;
			}

			if (!$ipn_save_result) {
				$this->log('Error saving the IPN to database. Request was: ' . var_export($this->request->data(), true));
				throw new InternalErrorException('Could not save the IPN');
			}
			$this->PaypalIpnRequest->dispatchEvent($this->request->data);
		} else {
			$this->log('Received an invalid Request from paypal', LogLevel::ERROR, 'PayPal');
		}
	}


	/**
	 * Converts an input to UTF8
	 *
	 * @param $input string|array|object
	 */
	private function utf8_encode_deep(&$input) {
		if (is_string($input)) {
			if  (mb_detect_encoding($input, 'UTF-8', true)) return;
			$input = utf8_encode($input);
		} else if (is_array($input)) {
			foreach ($input as &$value) {
				$this->utf8_encode_deep($value);
			}

			unset($value);
		} else if (is_object($input)) {
			$vars = array_keys(get_object_vars($input));
			foreach ($vars as $var) {
				$this->utf8_encode_deep($input->$var);
			}
		}
	}
}
