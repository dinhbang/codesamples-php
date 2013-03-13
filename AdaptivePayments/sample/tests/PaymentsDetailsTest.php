<?php
require_once 'sample/code/PaymentsDetails.php';

/**
 * Test class for PaymentsDetails sample.
 *
 */
class PaymentDetailsTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testPaymentDetails(){
		$paymentDetails = new PaymentDetails();
		$response = $paymentDetails->details();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->status);
	}
}