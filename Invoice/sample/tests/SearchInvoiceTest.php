<?php
require_once 'sample/code/SearchInvoices.php';

/**
 * Test class for SearchInvoices sample.
 *
 */
class SearchInvoicesTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testSearchInvoices(){
		$searchInvoice = new SearchInvoices();
		$response = $searchInvoice->search();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
	}
}