<?php
namespace PaypalIpn\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaypalItemsFixture
 *
 */
class PaypalItemsFixture extends TestFixture
{

	public $records = [
		[
			'instant_payment_notification_id' => 1,
			'item_name' => 'Lorem ipsum dolor sit amet',
			'item_number' => 'Lorem ipsum dolor sit amet',
			'quantity' => 'Lorem ipsum dolor sit amet',
			'mc_gross' => 1,
			'mc_shipping' => 1,
			'mc_handling' => 1,
			'tax' => 1,
			'created' => '2016-06-04 21:12:32',
			'modified' => '2016-06-04 21:12:32'
		],
	];
}
