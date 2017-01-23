<?php
namespace PaypalIpn\View\Helper;

use Cake\Core\Configure;
use Cake\Log\LogTrait;
use Cake\View\Helper;
use Cake\View\Helper\FormHelper;
use Cake\View\View;
use PaypalIpn\PayPalEWP;

/**
 * Paypal helper
 * @property FormHelper Form
 * @author Webtechnik
 * @author otoso
 */
class PaypalHelper extends Helper
{

	public $helpers = ['Html', 'Form'];
	/**
	 * Default configuration.
	 * @var array
	 */
	protected $_defaultConfig = [];
	private $encryption = [];
	use LogTrait;


	public function initialize(array $config)
	{
		//check if test or not
		//gather configurations based on test or not
	}

	/**
	 * Creates a complete form button to Pay Now, Donate,
	 * Add to Cart, or Subscribe using the paypal service.
	 * Configuration for the button is in /config/paypal_ip_config.php
	 *
	 * for this to work the option 'item_name' and 'amount' must be set in the array options or default config options.
	 *
	 * Example:
	 *  $paypal->button('Pay Now', ['amount' => '12.00', 'item_name' => 'test item']);
	 *  $paypal->button('Subscribe', ['type' => 'subscribe', 'amount' => '60.00', 'term' => 'month', 'period' => '2']);
	 *  $paypal->button('Donate', ['type' => 'donate', 'amount' => '60.00']);
	 *  $paypal->button('Add To Cart', ['type' => 'addtocart', 'amount' => '15.00']);
	 *  $paypal->button('View Cart', ['type' => 'viewcart']);
	 *  $paypal->button('Unsubscribe', ['type' => 'unsubscribe']);
	 *  $paypal->button('Checkout', [
	 *      'type' => 'cart',
	 *      'items' => [
	 *           ['item_name' => 'Item 1', 'amount' => '120', 'quantity' => 2, 'item_number' => '1234'],
	 *           ['item_name' => 'Item 2', 'amount' => '50'],
	 *           ['item_name' => 'Item 3', 'amount' => '80', 'quantity' => 3],
	 *       ]
	 *  ]);
	 *
	 * Test Example:
	 *  $paypal->button('Pay Now', ['test' => true, 'amount' => '12.00', 'item_name' => 'test item']);
	 *
	 * @access public
	 * @param string $title takes the title of the paypal button (default "Pay Now" or "Subscribe" depending on option['type'])
	 * @param array $options takes an options array type: 'paynow', 'addtocart', 'donate', 'unsubscribe', 'cart', or 'subscribe' (default 'paynow')
	 *
	 * You may pass in api name value pairs to be passed directly to the paypal
	 * form link. Refer to paypal.com for a complete list. Some Paypal API examples:
	 *   float amount      - value
	 *   string notify_url - url
	 *   string item_name  - name of product.
	 * @param array $buttonOptions
	 * @return string
	 */
	function button($title, $options = [], $buttonOptions = [])
	{
		$options = $this->getIpnConfig($options);
		$encryption = $options['encrypt'] ?? false;

		$options['type'] = $options['type'] ?? "paynow";

		switch ($options['type']) {
			case 'subscribe':   // Subscribe
				$options['cmd'] = '_xclick-subscriptions';
				$default_title = 'Subscribe';
				$options['no_note'] = 1;
				$options['no_shipping'] = 1;
				$options['src'] = 1;
				$options['sra'] = 1;
				$options = $this->subscriptionOptions($options);
				break;
			case 'addtocart':   // Add To Cart
				$options['cmd'] = '_cart';
				$options['add'] = '1';
				$default_title = 'Add To Cart';
				break;
			case 'viewcart':    // View Cart
				$options['cmd'] = '_cart';
				$options['display'] = '1';
				$default_title = 'View Cart';
				break;
			case 'donate':      // Doante
				$options['cmd'] = '_donations';
				$default_title = 'Donate';
				break;
			case 'unsubscribe': //Unsubscribe
				$options['cmd'] = '_subscr-find';
				$options['alias'] = $options['business'];
				$default_title = 'Unsubscribe';
				break;
			case 'cart':        // upload cart
				$options['cmd'] = '_cart';
				$options['upload'] = 1;
				$default_title = 'Checkout';
				$options = $this->uploadCartOptions($options);
				break;
			default:            // Pay Now
				$options['cmd'] = '_xclick';
				$default_title = 'Pay Now';
				break;
		}

		$buttonOptions['label'] = $title ?? $buttonOptions['label'] ?? $options['label'] ?? $default_title;

		$retval = "<form action='{$options['paypal_server']}/cgi-bin/webscr' method='post'><div class='paypal-form'>";
		unset($options['paypal_server']);

		$encryptedFields = false;
		if ($encryption) {
			$encryptedFields = $this->encryptFields($options, $encryption);
		}

		if ($encryptedFields === false) {
			foreach ($options as $name => $value) {
				$retval .= $this->hiddenNameValue($name, $value);
			}
		} else {
			$retval .= $encryptedFields;
		}

		$retval .= $this->submitButton($buttonOptions);

		return $retval;
	}

	/**
	 * Build the configuration from all sources. First file then,
	 * Helper config, then given $options array
	 * @param $options
	 * @return array
	 */
	private function getIpnConfig($options)
	{

		$test_mode = Configure::read('PayPalIpn.test_mode') || (isset($options['test_mode']) && $options['test_mode'] == true) || $this->config('test_mode');

		if ($test_mode) {
			$config_file = Configure::read('PayPalIpn.test');
		} else {
			$config_file = Configure::read('PayPalIpn.prod');
		}

		$output = array_merge($config_file, $this->config(), $options);

		if ($test_mode) {
			//Just to make sure that the URL is not messed up - not pretty, but secure
			$output['paypal_server'] = Configure::read('PayPalIpn.test.paypal_server');
		}
		return $output;
	}

	/**
	 * Converts human readable subscription terms into paypal terms if need be
	 *
	 * @param array $options | human readable options into paypal API options
	 *              int    period - paypal api period of term, 2, 3, 1
	 *              string term   - paypal API term //month, year, day, week
	 *              float  amount - paypal API amount to charge for perioud of term.
	 * @return array options
	 */
	private function subscriptionOptions($options = [])
	{
		// Period... every 1, 2, 3, etc.. Term
		if (isset($options['period'])) {
			$options['p3'] = $options['period'];
			unset($options['period']);
		}
		// Mount billed
		if (isset($options['amount'])) {
			$options['a3'] = $options['amount'];
			unset($options['amount']);
		}
		// Terms, Month(s), Day(s), Week(s), Year(s)
		if (isset($options['term'])) {
			switch ($options['term']) {
				case 'month':
					$options['t3'] = 'M';
					break;
				case 'year':
					$options['t3'] = 'Y';
					break;
				case 'day':
					$options['t3'] = 'D';
					break;
				case 'week':
					$options['t3'] = 'W';
					break;
				default:
					$options['t3'] = $options['term'];
			}
			unset($options['term']);
		}

		return $options;
	}

	/**
	 * Converts an array of items into paypal friendly name/value pairs
	 *
	 * @param array $options of options that will be returned with proper paypal friendly name/value pairs for items
	 * @return array options
	 */
	private function uploadCartOptions($options = [])
	{
		if (isset($options['items']) && is_array($options['items'])) {
			$count = 1;
			foreach ($options['items'] as $item) {
				foreach ($item as $key => $value) {
					$options[$key . '_' . $count] = $value;
				}
				$count++;
			}
			unset($options['items']);
		}
		return $options;
	}

	/**
	 * Constructs the name value pair in a hidden input html tag
	 *
	 * @param array $options hold key/value options of paypal button.
	 * @param array $encryption encryption configuration
	 * @return String hidden encrypted fields
	 */
	private function encryptFields($options, $encryption)
	{
		// Assign Build Notation for PayPal Support
		$options['bn'] = $encryption['bn'];

		$encrypter = new PayPalEWP();
		if (!$encrypter->setCertificateID($encryption['cert_id'])) {
			$this->log('Certificate id not valid', 'Paypal');
			return false;
		}

		if (!$encrypter->setPayPalCertificate($encryption['paypal_cert_file'])) {
			$this->log('Paypal certificate could not be loaded', 'Paypal');
			return false;
		}

		if (!$encrypter->setCertificate($encryption['cert_file'], $encryption['key_file'])) {
			$this->log('Certificate coul not be loaded', 'Paypal');
			return false;
		}

		$encryptedFields = $encrypter->encryptButton($options);


		return implode(' ', [
			'<input type="hidden" name="cmd" value="_s-xclick">',
			"<input type='hidden' name='encrypted' value='{$encryptedFields}' />"
		]);
	}

	/**
	 * @param string $name name is the name of the hidden html element.
	 * @param string $value value is the value of the hidden html element.
	 * @return string hidden html field
	 */
	private function hiddenNameValue($name, $value)
	{
		return "<input type='hidden' name='{$name}' value='{$value}' />";
	}

	/**
	 * Set $options['label'] as text or URL to image.
	 * @param array $options
	 * @return string html form button and close form
	 */
	private function submitButton($options = [])
	{
		return '</div>' . $this->Form->submit($options['label']) . $this->Form->end($options);
	}

	private function isEncryptionOn()
	{
		return $this->config('encrypt') !== false && is_array($this->config('encrypt'));
	}


}
