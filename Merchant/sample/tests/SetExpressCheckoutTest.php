<?php
require_once 'sample/code/SetExpressCheckout.php';

/**
* Test class for SetExpressCheckout sample.
*
*/
class SetExpressCheckoutTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function setExpressCheckoutTest(){
		$setEc = new SetExpressCheckout();
		$response = $setEc->setEC();
		$this->assertNotNull($response->Token);
	}
}