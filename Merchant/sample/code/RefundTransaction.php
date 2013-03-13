<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # RefundTransaction API
// The RefundTransaction API operation issues a refund to the PayPal account
// holder associated with a transaction.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class RefundTransaction {

	public function refund() {

		$logger = new PPLoggingManager('RefundTransaction');

		// ## RefundTransactionReq
		$refundTransactionReq = new RefundTransactionReq();
		$refundTransactionRequest = new RefundTransactionRequestType();

		// Either the `transaction ID` or the `payer ID` must be specified.
		// PayerID is unique encrypted merchant identification number
		// For setting `payerId`,
		// `refundTransactionRequest.setPayerID("A9BVYX8XCR9ZQ");`

		// Unique identifier of the transaction to be refunded.
		$refundTransactionRequest->TransactionID = "1GF88795WC5643301";

		// Type of refund you are making. It is one of the following values:
		//
		// * `Full` - Full refund (default).
		// * `Partial` - Partial refund.
		// * `ExternalDispute` - External dispute. (Value available since
		// version
		// 82.0)
		// * `Other` - Other type of refund. (Value available since version
		// 82.0)
		$refundTransactionRequest->RefundType = "Partial";

		// `Refund amount`, which contains
		//
		// * `Currency Code`
		// * `Amount`
		// The amount is required if RefundType is Partial.
		// `Note:
		// If RefundType is Full, do not set the amount.`
		$amount = new BasicAmountType("USD","1.00");
		$refundTransactionRequest->Amount = $amount;

		$refundTransactionReq->RefundTransactionRequest = $refundTransactionRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->RefundTransaction($refundTransactionReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// Unique transaction ID of the refund.
			$logger->log("Refund Transaction ID" . $response->RefundTransactionID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;

	}
}

