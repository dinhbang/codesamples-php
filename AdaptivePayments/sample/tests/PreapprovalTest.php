<?php
require_once 'sample/code/Preapproval.php';
/**
* Test class for Preapprovals sample.
*
*/
class PreapprovalTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testPreapproval(){
		$preapproval = new Preapproval();
		$response = $preapproval->preapprove();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->preapprovalKey);
	}
}
