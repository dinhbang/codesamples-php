<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # DoReferenceTransaction API
// The DoReferenceTransaction API operation processes a payment from a
// buyer's account, which is identified by a previous transaction.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class DoReferenceTransaction {

	public function doReferenceTxn() {

		$logger = new PPLoggingManager('DoReferenceTransaction');

		// ## DoReferenceTransactionReq
		$doReferenceTransactionReq = new DoReferenceTransactionReq();

		// Information about the payment.
		$paymentDetails = new PaymentDetailsType();

		// The total cost of the transaction to the buyer. If shipping cost and
		// tax charges are known, include them in this value. If not, this value
		// should be the current subtotal of the order.

		// If the transaction includes one or more one-time purchases, this field must be equal to
		// the sum of the purchases. Set this field to 0 if the transaction does
		// not include a one-time purchase such as when you set up a billing
		// agreement for a recurring payment that is not immediately charged.
		// When the field is set to 0, purchase-specific fields are ignored
		//
		// * `Currency ID` - You must set the currencyID attribute to one of the
		// 3-character currency codes for any of the supported PayPal
		// currencies.
		// * `Amount`
		$orderTotal = new BasicAmountType("USD","3.00");
		$paymentDetails->OrderTotal = $orderTotal;

		//Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
		$paymentDetails->NotifyURL = "http://localhost/ipn";

		// `DoReferenceTransactionRequestDetails` takes mandatory params:
		//
		// * `Reference Id` - A transaction ID from a previous purchase, such as a
		// credit card charge using the DoDirectPayment API, or a billing
		// agreement ID.
		// * `Payment Action Code` - How you want to obtain payment. It is one of
		// the following values:
		// * Authorization
		// * Sale
		// * Order
		// * None
		// * `Payment Details`
		$doReferenceTransactionRequestDetails = new DoReferenceTransactionRequestDetailsType("97U72738FY126561H", "Sale", $paymentDetails);


		$doReferenceTransactionRequest = new DoReferenceTransactionRequestType($doReferenceTransactionRequestDetails);
		$doReferenceTransactionReq->DoReferenceTransactionRequest = $doReferenceTransactionRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->DoReferenceTransaction($doReferenceTransactionReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// The final amount charged, including any shipping and taxes from your Merchant Profile.
			$logger->log("Amount: " . $response->DoReferenceTransactionResponseDetails->Amount->value
			. $response->DoReferenceTransactionResponseDetails->Amount->currencyID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

