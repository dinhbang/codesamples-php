<?php
require_once 'sample/code/Refund.php';
/**
* Test class for Refund sample.
*
*/
class RefundTest{
	
	public function testRefund(){
		$refund = new Refund();
		$response = $refund->refundTheAmt();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->refundInfoList->refundInfo);
	}
}

