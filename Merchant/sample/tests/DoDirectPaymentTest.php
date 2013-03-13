<?php
require_once 'sample/code/DoDirectPayment.php';

/**
* Test class for DoDirectPayment sample.
*
*/
class DoDirectPaymentTest extends PHPUnit_Framework_TestCase{
	
	/**
	 *@test 
	 */
	public function doDirectPaymentTest(){
		$ddp = new DoDirectPayment();
		$response = $ddp->doDirectPay();
		$this->assertNotNull($response->TransactionID);
	}
}