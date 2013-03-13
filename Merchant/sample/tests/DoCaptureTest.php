<?php
require_once 'sample/code/DoCapture.php';

/**
* Test class for DoCapture sample. Have to alter input values in Sample for successful run.
*
*/

class DoCaptureTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function testDoCapture(){
		$doCapture = new DoCapture();
		$response = $doCapture->capture();
		$this->assertNotNull($response->DoCaptureResponseDetails->AuthorizationID);
	}
}