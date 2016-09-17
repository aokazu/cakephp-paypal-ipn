<?php
namespace PaypalIpn\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Log\LogTrait;
use Cake\Network\Exception\InternalErrorException;
use PaypalIpn\Controller\Component\PaypalIpnRequestComponent;
use PaypalIpn\Model\Entity\InstantPaymentNotification;
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
		$this->loadComponent('PaypalIpn.PaypalIpnRequest');
		if ($this->PaypalIpnRequest->validate($this->request->data)) {
			$instantPaymentNotification = $this->InstantPaymentNotifications->newEntity($this->request->data);

			if (!is_int($this->request->data('num_cart_items')) && $this->request->data('num_cart_items') > 0) {
				$items = [];
				for ($i = 1; $i <= $this->request->data('num_cart_items'); $i++) {
					$key = $i - 1;
					$items[$key]['item_name'] = $this->request->data("item_name{$i}");
					$items[$key]['item_number'] = $this->request->data("item_number{$i}");
					$items[$key]['item_number'] = $this->request->data("item_number{$i}");
					$items[$key]['quantity'] = $this->request->data("quantity{$i}");
					$items[$key]['mc_shipping'] = $this->request->data("mc_shipping{$i}");
					$items[$key]['mc_handling'] = $this->request->data("mc_handling{$i}");
					$items[$key]['mc_gross'] = $this->request->data("mc_gross_{$i}");
					$items[$key]['tax'] = $this->request->data("tax{$i}");
				}
				$this->InstantPaymentNotifications->PaypalItems = $items;
			}

			if (!$this->InstantPaymentNotifications->save($instantPaymentNotification)) {
				$this->log('Error saving the IPON to database. Request was: ' . var_export($this->request->data(), true));
				throw new InternalErrorException('Could not save the IPN');
			}
			$this->PaypalIpnRequest->dispatchEvent($this->request->data);
		} else {
			$this->log('Received an invalid Request from paypal', LogLevel::ERROR, 'PayPal');
		}
	}
}
