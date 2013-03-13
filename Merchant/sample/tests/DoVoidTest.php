<?php
require_once 'sample/code/DoVoid.php';

/**
 * Test class for DoVoid sample. Have to alter input values in sample for successful run.
 *
 */

class DoVoidTest extends PHPUnit_Framework_TestCase{

	/**
	 * @test
	 */
	public function testDoVoid(){
		$doVoid = new DoVoid();
		$response = $doVoid->void();
		$this->assertNotNull($response->AuthorizationID);
	}
}