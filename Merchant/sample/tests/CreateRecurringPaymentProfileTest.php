<?php
require_once ('sample/code/CreateRecurringPaymentProfile.php');

/**
* Test class for CreateRecurringPaymentProfile sample.
*
*/
class CreateRecurringPaymentProfileTest extends PHPUnit_Framework_TestCase{
		
	/**
	 * @test
	 */
	public function createRecurringPaymentProfileTest(){
		$RPP = new CreateRecurringPaymentProfile();
		$response = $RPP->createRecurringProfile();
		$this->assertNotNull($response->CreateRecurringPaymentsProfileResponseDetails->ProfileID); 
	}
}