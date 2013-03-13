<?php
require_once 'sample/code/DoAuthorization.php';

/**
* Test class for DoAuthorization sample. Have to alter input values in Sample for successful run.
*
*/

class DoAuthorizationTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/	
	public function doAuthorizationTest(){
		$doAuth = new DoAuthorization();
		$response = $doAuth->doAuth();
		$this->assertNotNull($response->TransactionID);
	}
}