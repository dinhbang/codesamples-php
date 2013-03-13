<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # DoCapture API
// Captures an authorized payment.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class DoCapture{

	public function capture(){
		$logger = new PPLoggingManager('DoCapture');

		// `Amount` to capture which takes mandatory params:
		//
		// * `currencyCode`
		// * `amount`
		$amount = new BasicAmountType("USD", "1.00");

		// `DoCaptureRequest` which takes mandatory params:
		//
		// * `Authorization ID` - Authorization identification number of the
		// payment you want to capture. This is the transaction ID returned from
		// DoExpressCheckoutPayment, DoDirectPayment, or CheckOut. For
		// point-of-sale transactions, this is the transaction ID returned by
		// the CheckOut call when the payment action is Authorization.
		// * `amount` - Amount to capture
		// * `CompleteCode` - Indicates whether or not this is your last capture.
		// It is one of the following values:
		// * Complete – This is the last capture you intend to make.
		// * NotComplete – You intend to make additional captures.
		// `Note:
		// If Complete, any remaining amount of the original authorized
		// transaction is automatically voided and all remaining open
		// authorizations are voided.`
		$doCaptureReqest = new DoCaptureRequestType("O-4VR15106P7416533H", $amount, "NotComplete");

		// ## DoCaptureReq
		$doCaptureReq = new DoCaptureReq();
		$doCaptureReq->DoCaptureRequest = $doCaptureReqest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->DoCapture($doCaptureReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if($response->Ack == "Success"){
			// ## Accessing response parameters
			// You can access the response parameters using getter methods in
			// response object as shown below
			// ### Success values
			$logger->log("Authorization ID:". $response->DoCaptureResponseDetails->AuthorizationID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->Errors[0]->LongMessage);
		}
		
		return $response;
	}
}

