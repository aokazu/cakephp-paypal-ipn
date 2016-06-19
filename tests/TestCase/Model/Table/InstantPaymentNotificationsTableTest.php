<?php
namespace PaypalIpn\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use PaypalIpn\Model\Table\InstantPaymentNotificationsTable;

/**
 * PaypalIpn\Model\Table\InstantPaymentNotificationsTable Test Case
 */
class InstantPaymentNotificationsTableTest extends TestCase
{

	/**
	 * Test subject
	 *
	 * @var \PaypalIpn\Model\Table\InstantPaymentNotificationsTable
	 */
	public $InstantPaymentNotifications;

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
		'plugin.paypal_ipn.instant_payment_notifications',
		'plugin.paypal_ipn.paypal_items'
	];

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$config = TableRegistry::exists('InstantPaymentNotifications') ? [] : ['className' => 'PaypalIpn\Model\Table\InstantPaymentNotificationsTable'];
		$this->InstantPaymentNotifications = TableRegistry::get('InstantPaymentNotifications', $config);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->InstantPaymentNotifications);

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
