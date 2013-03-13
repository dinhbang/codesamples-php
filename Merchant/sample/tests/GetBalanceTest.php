<?php
require_once 'sample/code/GetBalance.php';

/**
* Test class for GetBalance sample.
*
*/
class GetBalanceTest extends PHPUnit_Framework_TestCase{
	
	/**
	 * @test
	 */
	public function GetBalanceTest(){
		$balance = new GetBalance();
		$response = $balance->getBal();
		$this->assertNotNull($response->BalanceHoldings);
	}
}