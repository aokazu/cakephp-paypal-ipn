<?php
namespace PaypalIpn\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use PaypalIpn\View\Helper\PaypalHelper;

/**
 * PaypalIpn\View\Helper\PaypalHelper Test Case
 */
class PaypalHelperTest extends TestCase
{

	/**
	 * Test subject
	 *
	 * @var \PaypalIpn\View\Helper\PaypalHelper
	 */
	public $Paypal;

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$view = new View();
		$this->Paypal = new PaypalHelper($view);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->Paypal);
		parent::tearDown();
	}

	public function testButton()
	{
		$result = $this->Paypal->button('Pay Now33', ['test_mode' => true, 'amount' => '12.00', 'item_name' => 'test item']);
		$this->assertTextContains('Pay Now33', $result);
		$this->assertTextContains('sandbox', $result);
		$this->assertTextContains('test item', $result);
	}


	public function testMultiItemButton()
	{
		$result = $this->Paypal->button('Checkout', [
			'type' => 'cart',
			'items' => [
				['item_name' => 'Item 1', 'amount' => '120', 'quantity' => 2, 'item_number' => '1234'],
				['item_name' => 'Item 2', 'amount' => '50'],
				['item_name' => 'Item 3', 'amount' => '80', 'quantity' => 3],
			]
		]);

		$this->assertTextContains('Item 1', $result);
		$this->assertTextContains('Item 2', $result);
		$this->assertTextContains('Item 3', $result);

	}
}
