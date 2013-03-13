<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

class DoReauthorization {

	// # DoReauthorization API
	// Authorize a payment.
	// This sample code uses Merchant PHP SDK to make API call. You can
	// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
	public function doReauth() {

		$logger = new PPLoggingManager('DoReauthorization');

		// ## DoAuthorizationReq
		$doReauthorizationReq = new DoReauthorizationReq();

		// `Amount` to reauthorize which takes mandatory params:
		//
		// * `currencyCode`
		// * `amount`
		$amount = new BasicAmountType("USD","3.00");

		// `DoReauthorizationRequest` which takes mandatory params:
		//
		// * `Authorization Id` - Value of a previously authorized transaction
		// identification number returned by PayPal.
		// * `amount`
		$doReauthorizationRequest = new DoReauthorizationRequestType("9B2288061E685550E", $amount);
		$doReauthorizationReq->DoReauthorizationRequest = $doReauthorizationRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->doReauthorization($doReauthorizationReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// Authorization identification number
			$logger->log("Authorization ID:" . $response->AuthorizationID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

