<?php
require_once 'sample/code/RequestPermissions.php';
/**
* Test class for RequestPermissions sample.
*
*/

class RequestPermissionsTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testRequestPermission(){
		$requestPermission = new RequestPermissions();
		$response = $requestPermission->requestPerm();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->token);
	}
}