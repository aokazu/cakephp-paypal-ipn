<?php
namespace PaypalIpn\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Log\LogTrait;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;
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

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PaypalIpn.InstantPaymentNotifications');

        $this->loadComponent('PaypalIpn.PaypalIpnRequest');
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

            $ipn_entity = $this->InstantPaymentNotifications->newEntity($instantPaymentNotification);

            if (!$this->InstantPaymentNotifications->save($ipn_entity)) {
                $this->log('Error saving the IPON to database. Request was: ' . var_export($this->request->data(), true));
                throw new InternalErrorException('Could not save the IPN');
            }
            $this->PaypalIpnRequest->dispatchEvent($this->request->data);
        } else {
            $this->log('Received an invalid Request from paypal', LogLevel::ERROR, 'PayPal');
        }
    }
}
