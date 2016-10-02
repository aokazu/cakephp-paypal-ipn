<?php
namespace PaypalIpn\Test\TestCase\Controller\Component;

use Cake\Chronos\Traits\TestingAidTrait;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Network\Http\Response;
use Cake\TestSuite\TestCase;
use PaypalIpn\Controller\Component\PaypalIpnRequestComponent;
use PHPUnit_Framework_MockObject_Generator;

/**
 * PaypalIpn\Controller\Component\PaypalIpnRequestComponent Test Case
 */
class PaypalIpnRequestComponentTest extends TestCase
{

	/**
	 * Test subject
	 *
	 * @var \PaypalIpn\Controller\Component\PaypalIpnRequestComponent
	 */
	public $PaypalIpnRequest;

	private $ipn_instant =
		array(
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
		);

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$registry = new ComponentRegistry();

		$mocko = new PHPUnit_Framework_MockObject_Generator();
		$this->PaypalIpnRequest = $mocko->getMockForAbstractClass('PaypalIpn\Controller\Component\PaypalIpnRequestComponent', [$registry], 'PaypalIpnRequestComponent_Mock', true, true, true, ['queryPayPal']);

	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->PaypalIpnRequest);

		parent::tearDown();
	}


	public function testValidate()
	{
		$this->mockPayPalResponse('VERIFIED', 200);

		$result = $this->PaypalIpnRequest->validate([]);
		$this->assertTrue($result);
	}

	/**
	 * @param $answer
	 */
	private function mockPayPalResponse($answer, $code)
	{
		$response = ['body' => $answer, 'code' => $code];

		$this->PaypalIpnRequest->expects($this->once())
			->method('queryPayPal')
			->will($this->returnValue($response));
	}

	public function testDispatch()
	{

		$message = [
			'txn_type' => 'mp_cancel',
			'cat' => 'mew'
		];


		$dispatched = false;
		$this->PaypalIpnRequest->eventManager()->on(
			'PayPal.IPN.mp_cancel',
			function (Event $event) use (&$dispatched, $message) {
				$this->assertEquals($message, $event->data);
				$dispatched = true;
			}
		);

		$this->PaypalIpnRequest->dispatchEvent($message);
		$this->assertTrue($dispatched);
	}
}
