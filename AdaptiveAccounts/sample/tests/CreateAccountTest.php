<?php
require_once 'sample/code/CreateAccount.php';

/**
* Test class for CreateAccount sample.
*
*/
class CreateAccountTest extends PHPUnit_Framework_TestCase{
	/**
	 * @test
	 */
	public function testPersonalAccount(){
		$personalAccount = new CreateAccount();
		$response = $personalAccount->createPersonalAccount();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->createAccountKey);
	}
	
	/**
	 * @test
	 */
	public function testPremierAccount(){
		$premierAccount = new CreateAccount();
		$response = $premierAccount->createPremierAccount();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->createAccountKey);
	}
	
	/**
	 * @test
	 */
	public function testBusinessAccount(){
		$businessAccount = new CreateAccount();
		$response = $businessAccount->createBusinessAccount();
		$this->assertEquals("Success",$response->responseEnvelope->ack);
		$this->assertNotNull($response->createAccountKey);
	}
}
