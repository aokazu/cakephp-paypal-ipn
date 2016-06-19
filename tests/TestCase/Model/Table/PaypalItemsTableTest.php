<?php
namespace PaypalIpn\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use PaypalIpn\Model\Table\PaypalItemsTable;

/**
 * PaypalIpn\Model\Table\PaypalItemsTable Test Case
 */
class PaypalItemsTableTest extends TestCase
{

	/**
	 * Test subject
	 *
	 * @var \PaypalIpn\Model\Table\PaypalItemsTable
	 */
	public $PaypalItems;

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
		'plugin.paypal_ipn.paypal_items',
		'plugin.paypal_ipn.instant_payment_notifications'
	];

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$config = TableRegistry::exists('PaypalItems') ? [] : ['className' => 'PaypalIpn\Model\Table\PaypalItemsTable'];
		$this->PaypalItems = TableRegistry::get('PaypalItems', $config);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->PaypalItems);

		parent::tearDown();
	}

	/**
	 * Test initialize method
	 *
	 * @return void
	 */
	public function testInitialize()
	{
		$this->markTestIncomplete('Not implemented yet.');
	}

	/**
	 * Test validationDefault method
	 *
	 * @return void
	 */
	public function testValidationDefault()
	{
		$this->markTestIncomplete('Not implemented yet.');
	}

	/**
	 * Test buildRules method
	 *
	 * @return void
	 */
	public function testBuildRules()
	{
		$this->markTestIncomplete('Not implemented yet.');
	}
}
