<?php
require_once 'sample/code/ConvertCurrency.php';

/**
* Test class for ConvertCurrency sample.
*
*/

class ConvertCurrencyTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testConvertCurrency(){
		$convertCurrency = new ConvertCurrency();
		$response = $convertCurrency->convert();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->estimatedAmountTable->currencyConversionList);
		$this->assertGreaterThan(0,count($response->estimatedAmountTable->currencyConversionList));
	}
}