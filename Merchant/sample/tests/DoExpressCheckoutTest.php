<?php
require_once 'sample/code/DoExpressCheckout.php';

/**
* Test class for DoExpressCheckout sample. Have to alter input values in Sample for successful run.
*
*/

class DoExpressCheckoutTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function testDoExpressCheckout(){
		$doEc = new DoExpressCheckout();
		$response = $doEc->doEC();
		$this->assertNotNull($doExpressCheckoutPaymentResponse->DoExpressCheckoutPaymentResponseDetails->PaymentInfo);
	}
	
}