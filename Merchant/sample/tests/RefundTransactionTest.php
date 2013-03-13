<?php
require_once 'sample/code/RefundTransaction.php';

/**
* Test class for RefundTransaction sample. Have to alter input values in Sample for successful run
*
*/
class RefundTransactionTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function testRefundTransaction(){
		$refund = new RefundTransaction();
		$response = $refund->refund();
		$this->assertNotNull($response->RefundTransactionID);
	}
}