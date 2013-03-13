<?php
require_once 'sample/code/Pay.php';

/**
* Test class for Pay sample.
*
*/
class PayTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function testSimplePay(){
		$simplePay = new Pay();
		$response = $simplePay->simplePay();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->payKey);
	}
	
	/**
	 * @test
	 */
	public function testChainedPay(){
		$chainedPay = new Pay();
		$response = $chainedPay->chainPay();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->payKey);
	}
	
	/**
	 * @test
	 */
	public function testParallelPay(){
		$parallelPay = new Pay();
		$response = $parallelPay->parallelPay();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->payKey);
	}
}