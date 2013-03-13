<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # GetBalance API
// The GetBalance API Operation obtains the available balance for a PayPal account.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class GetBalance {
	public function getBal() {

		$logger = new PPLoggingManager('GetBalance');

		// ## GetBalanceReq
		$getBalanceReq = new GetBalanceReq();
		$getBalanceRequest = new GetBalanceRequestType();

		// Indicates whether to return all currencies. It is one of the
		// following values:
		//
		// * 0 – Return only the balance for the primary currency holding.
		// * 1 – Return the balance for each currency holding.
		$getBalanceRequest->ReturnAllCurrencies = "1";
		$getBalanceReq->GetBalanceRequest = $getBalanceRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->GetBalance($getBalanceReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			$balanceHoldingArray = $response->BalanceHoldings;
			foreach($balanceHoldingArray as $amount) {
				$logger->log("Balance Holdings : " + $amount->value .  $amount->currencyID);
			}
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;

	}
}

