<?php
require_once 'sample/code/DoReauthorization.php';

/**
* Test class for DoReauthorization sample. Have to alter input values in Sample for successful run.
*
*/

class DoReauthorizationTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function testDoReauthorization(){
		$doReauth = new DoReauthorization();
		$response = $doReauth->doReauth();
		$this->assertNotNull($response->AuthorizationID);
	}
}