<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # GetExpressCheckout API
// The GetExpressCheckoutDetails API operation obtains information about
// an Express Checkout transaction.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class GetExpressCheckout {

	public function getEC() {

		$logger = new PPLoggingManager('GetExpressCheckout');

		// ## GetExpressCheckoutDetailsReq
		$getExpressCheckoutDetailsReq = new GetExpressCheckoutDetailsReq();

		// A timestamped token, the value of which was returned by
		// `SetExpressCheckout` response.
		$setEc = new SetExpressCheckout();
		$setEcResponse = $setEc->setExpressCheckout();
		var_dump($setEcResponse->Token);
		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($setEcResponse->Token);
		$getExpressCheckoutDetailsReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->GetExpressCheckoutDetails($getExpressCheckoutDetailsReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// PayerID is PayPal Customer Account identification number
			// ($response->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID). This
			// value will be null unless you authorize the payment by
			// redirecting to PayPal after `SetExpressCheckout` call.
			$logger->log("PayerID : " . $response->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;

	}
}

