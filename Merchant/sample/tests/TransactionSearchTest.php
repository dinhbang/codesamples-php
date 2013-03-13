<?php
require_once 'sample/code/TransactionSearch.php';

/**
* Test class for TransactionSearch sample. Have to alter input values in Sample for successful run
*
*/

class TransactionSearchTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function testTransactionSearch(){
		$txnSearch = new TransactionSearch();
		$response = $txnSearch->searchTxn();
		$this->assertEquals("Success",$response->Ack);
		$this->assertNotNull($response->PaymentTransactions);
	}
}