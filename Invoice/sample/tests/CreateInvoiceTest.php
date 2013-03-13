<?php
require_once 'sample/code/CreateInvoice.php';

/**
* Test class for CreateInvoice sample.
*
*/
class CreateInvoiceTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testCreateInvoice(){
		$createInvoice = new CreateInvoice();
		$response = $createInvoice->invoice();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->invoiceID);
	}
}
