<?php
require_once 'sample/code/GetExpressCheckout.php';

/**
* Test class for GetExpressCheckout sample. Have to alter input values in Sample for successful run.
*
*/

class GetExpressCheckoutTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function getExpressCheckoutTest(){
		$getEc = new GetExpressCheckout();
		$response = $getEc->getEC();
		$this->assertNotNull($response->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID);
	}
}