<?php
require_once 'sample/code/DoReferenceTransaction.php';

/**
* Test class for DoReferenceTransaction sample.
*
*/
class DoReferenceTransactionTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test 
	 */
	public function doReferenceTransactionTest(){
		$doRefTxn = new DoReferenceTransaction();
		$response = $doRefTxn->doReferenceTxn();
		$this->assertEquals("Success",$response->Ack);
		$this->assertNotNull($response->DoReferenceTransactionResponseDetails->Amount);
	}
}