<?php
require_once 'sample/code/PreapprovalDetails.php';
/**
* Test class for PreapprovalDetails sample.
*
*/
class PreapprovalDetailsTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testPreapprovalDetails(){
		$details = new PreapprovalDetails();
		$response = $details->preapproveDetails();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->startingDate);
	}
}