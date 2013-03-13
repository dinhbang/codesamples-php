<?php
require_once 'sample/code/CreateAndSendInvoice.php';
/**
* Test class for CreateAndSendInvoice sample.
*
*/

class CreateAndSendInvoiceTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testCreateAndSendInvoice(){
		$createAndSendInvoice = new CreateAndSendInvoice();
		$response = $createAndSendInvoice->createSendInvoice();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->invoiceID);
	}
}