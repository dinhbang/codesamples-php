<?php
require_once 'sample/code/GetAccessToken.php';

/**
 * Test class for GetAccessToken sample. Have to update values in sample code for succcessful run.
 *
 */

class GetAccessTokenTest extends PHPUnit_Framework_TestCase{

	/**
	 * @test
	 */
	public function testGetAccessToken(){
		$getAT = new GetAccessToken();
		$response = $getAT->getAT();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->token);
	}
}