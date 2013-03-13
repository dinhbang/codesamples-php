<?php
require_once 'sample/code/SendInvoice.php';

/**
* Test class for SendInvoice sample.
*
*/
class SendInvoiceTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testSendInvoice(){
		$sendInvoice = new SendInvoice();
		$response = $sendInvoice->send();
		var_dump($response);
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->invoiceID); 
	}
} 

