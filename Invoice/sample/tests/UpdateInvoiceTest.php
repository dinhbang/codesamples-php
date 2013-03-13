<?php
require_once 'sample/code/UpdateInvoice.php';

/**
* Test class for UpdateInvoice sample.
*
*/
class UpdateInvoiceTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testUpdateInvoice(){
		$updateInvoice = new UpdateInvoice();
		$response = $updateInvoice->update();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->invoiceID);
	}
}