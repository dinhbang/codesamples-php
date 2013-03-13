<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # DoAuthorization API
// Authorize a payment.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class DoAuthorization{

	public function doAuth(){
		$logger = new PPLoggingManager('DoAuthorization');

		// `Amount` which takes mandatory params:
		//
		// * `currencyCode`
		// * `amount`
		$amount = new BasicAmountType("USD", "4.00");

		// `DoAuthorizationRequest` which takes mandatory params:
		//
		// * `Transaction ID` - Value of the order's transaction identification
		// number returned by PayPal.
		// * `Amount` - Amount to authorize.
		$doAuthRequest = new DoAuthorizationRequestType("O-4VR15106P7416533H", $amount);

		// ## DoAuthorizationReq
		$doAuthReq = new DoAuthorizationReq();
		$doAuthReq->DoAuthorizationRequest =$doAuthRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->DoAuthorization($doAuthReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if($response->Ack == "Success"){
			// Authorization identification number
			$logger->log("Transaction ID:". $response->TransactionID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

