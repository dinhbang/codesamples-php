<?php
require_once 'sample/code/MassPay.php';

/**
* Test class for MassPay sample.
*
*/
class MassPayTest extends PHPUnit_Framework_TestCase{
	
	/**
	* @test
	*/
	public function MassPayTest(){
		$massPay = new MassPay();
		$response = $massPay->payMass();
		$this->assertEquals("Success", $response->Ack);
	}
}