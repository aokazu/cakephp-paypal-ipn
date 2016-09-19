<?php
namespace PaypalIpn\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use PaypalIpn\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\TestSuite\IntegrationTestCase;
use PaypalIpn\Controller\InstantPaymentNotificationsController;

use Cake\Network\Response;
use Cake\TestSuite\TestCase;
use PaypalIpn\Controller\Component\PaypalIpnRequestComponent;
use PaypalIpn\Model\Table\InstantPaymentNotificationsTable;
use PHPUnit_Framework_MockObject_Generator;


/**
 * PaypalIpn\Controller\InstantPaymentNotificationsController Test Case
 */
class InstantPaymentNotificationsControllerTest extends IntegrationTestCase
{

    public $fixtures = [
        'plugin.paypal_ipn.InstantPaymentNotifications',
        'plugin.paypal_ipn.PaypalItems'
    ];

    private $test_request =
        [
            'id' => '53f0e6d1-2640-407c-8e95-380a5f8f2345',
            'payment_type' => 'instant',
            'payment_date' => 'Mon Jun 06 2016 23:08:00 GMT 0200 (W. Europe Daylight Time)',
            'payment_status' => 'Completed',
            'payer_status' => 'verified',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'payer_email' => 'buyer@paypalsandbox.com',
            'payer_id' => 'TESTBUYERID01',
            'address_name' => 'John Smith',
            'address_country' => 'United States',
            'address_country_code' => 'US',
            'address_zip' => '95131',
            'address_state' => 'CA',
            'address_city' => 'San Jose',
            'address_street' => '123 any street',
            'business' => 'seller@paypalsandbox.com',
            'receiver_email' => 'seller@paypalsandbox.com',
            'receiver_id' => 'seller@paypalsandbox.com',
            'residence_country' => 'US',
            'num_cart_items' => '1',
            'item_name1' => 'something',
            'item_number1' => 'AK-1234',
            'quantity' => '1',
            'shipping' => '3.04',
            'tax' => '2.02',
            'mc_currency' => 'USD',
            'mc_fee' => '0.44',
            'mc_gross' => '12.34',
            'mc_gross_1' => '12.34',
            'mc_handling' => '2.06',
            'mc_handling1' => '1.67',
            'mc_shipping' => '3.02',
            'mc_shipping1' => '1.02',
            'txn_type' => 'cart',
            'txn_id' => '899327589',
            'notify_version' => '2.4',
            'custom' => 'xyz123',
            'invoice' => 'abc1234',
            'test_ipn' => '1',
            'verify_sign' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31A6653TbtoE49HuuH-TUJcr.o2Pkj',
        ];


    public function controllerSpy($event, $controller = null){
        parent::controllerSpy($event, $controller);
        if (isset($this->_controller)) {
            $this->_controller->PaypalIpnRequest = $this->createMock('PaypalIpn\Controller\Component\PaypalIpnRequestComponent');

            $this->_controller->PaypalIpnRequest->expects($this->any())
                ->method('validate')
                ->will($this->returnValue(true));
        }
    }



    public function testProcess()
    {
        $this->PaypalItems = TableRegistry::get('PaypalIpn.PaypalItems');
        $items_before = $this->PaypalItems->find('all')->count();

        $this->InstantPaymentNotifications = TableRegistry::get('PaypalIpn.InstantPaymentNotifications');
        $notifications_before = $this->InstantPaymentNotifications->find()->all()->count();

        $this->post('/paypal_ipn/InstantPaymentNotifications/process',$this->test_request);

        $notifications_after = $this->InstantPaymentNotifications->find()->all()->count();
        $this->assertEquals($notifications_before+1, $notifications_after);

        $items_after = $this->PaypalItems->find('all')->count();
        $this->assertEquals($items_before+1, $items_after);

        $this->assertResponseSuccess();
    }
}