<?php
require_once ('sample/code/GetTransactionDetails.php');

/**
* Test class for GetTransactionDetails sample.
*
*/
class GetTransactionDetailsTest extends PHPUnit_Framework_TestCase{
		
	/**
	 * @test
	 */
	public function getTransactionDetailsTest(){
		$transactionDetail = new GetTransactionDetails();
		$response = $transactionDetail->getTxnDetails();
		$this->assertNotNull($response->PaymentTransactionDetails->PayerInfo->PayerID); 
	}
}