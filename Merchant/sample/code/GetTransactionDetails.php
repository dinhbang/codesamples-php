<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # GetTransactionDetails API
// The GetTransactionDetails API operation obtains information about a
// specific transaction.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
 class GetTransactionDetails {


	public function getTxnDetails() {

		$logger = new PPLoggingManager('GetTransactionDetails');

		// ## GetTransactionDetailsReq
		$getTransactionDetailsReq = new GetTransactionDetailsReq();
		$getTransactionDetailsRequest = new GetTransactionDetailsRequestType();

		// Unique identifier of a transaction.
		// `Note:
		// The details for some kinds of transactions cannot be retrieved with
		// GetTransactionDetails. You cannot obtain details of bank transfer
		// withdrawals, for example.`
		$getTransactionDetailsRequest->TransactionID = "5AT5731435011481X";
		$getTransactionDetailsReq->GetTransactionDetailsRequest = $getTransactionDetailsRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->GetTransactionDetails($getTransactionDetailsReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// Unique PayPal Customer Account identification number.
			$logger->log("Payer ID:" . $response->PaymentTransactionDetails->PayerInfo->PayerID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

