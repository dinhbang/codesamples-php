<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # DoVoid API
// Void an order or an authorization.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class DoVoid {

	public function void() {

		$logger = new PPLoggingManager('DoVoid');

		// ## DoVoidReq
		$doVoidReq = new DoVoidReq();

		// DoVoidRequest which takes mandatory params:
		//
		// * `Authorization ID` - Original authorization ID specifying the
		// authorization to void or, to void an order, the order ID.
		// `Important:
		// If you are voiding a transaction that has been reauthorized, use the
		// ID from the original authorization, and not the reauthorization.`
		$doVoidRequest = new DoVoidRequestType("9B2288061E685550E");
		$doVoidReq->DoVoidRequest = $doVoidRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->DoVoid($doVoidReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}

		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {

			// Authorization identification number you specified in the
			// request.
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

