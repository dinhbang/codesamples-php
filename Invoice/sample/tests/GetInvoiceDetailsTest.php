<?php
require_once 'sample/code/GetInvoiceDetails.php';

/**
* Test class for GetInvoiceDetails sample.
*
*/

class GetInvoiceDetailsTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testGetInvoiceDetails(){
		$invoiceDetails = new GetInvoiceDetails();
		$response = $invoiceDetails->getDetails();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->invoiceDetails->status);
	}
}