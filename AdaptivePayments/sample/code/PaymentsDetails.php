<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # PaymentDetails API
// Use the PaymentDetails API operation to obtain information about a payment. You can identify the payment by your tracking ID, the PayPal transaction ID in an IPN message, or the pay key associated with the payment.
// This sample code uses AdaptivePayments PHP SDK to make API call. You can
// download the SDK [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptivepayments-sdk/php)
class PaymentDetails
{

	public function details()
	{

		$logger = new PPLoggingManager('PaymentDetails');
		
		// ##PaymentDetailsRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// PaymentDetailsRequest which takes,
		// `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		$paymentDetailsReq = new PaymentDetailsRequest($requestEnvelope);

		// You must specify either,
		//
		// * `Pay Key` - The pay key that identifies the payment for which you want to retrieve details. This is the pay key returned in the PayResponse message.
		// * `Transaction ID` - The PayPal transaction ID associated with the payment. The IPN message associated with the payment contains the transaction ID.
		// `paymentDetailsRequest.setTransactionId(transactionId)`
		// * `Tracking ID` - The tracking ID that was specified for this payment in the PayRequest message.
		// `paymentDetailsRequest.setTrackingId(trackingId)`
		$paymentDetailsReq->payKey = "AP-86H50830VE600922B";

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptivePaymentsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->PaymentDetails($paymentDetailsReq);
			
		} catch(Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success")
		{
		
			// The status of the payment. Possible values are:
			//
			// * CREATED - The payment request was received; funds will be
			// transferred once the payment is approved
			// * COMPLETED - The payment was successful
			// * INCOMPLETE - Some transfers succeeded and some failed for a
			// parallel payment or, for a delayed chained payment, secondary
			// receivers have not been paid
			// * ERROR - The payment failed and all attempted transfers failed
			// or all completed transfers were successfully reversed
			// * REVERSALERROR - One or more transfers failed when attempting
			// to reverse a payment
			// * PROCESSING - The payment is in progress
			// * PENDING - The payment is awaiting processing
			$logger->log("Payment Status : ".$response->status);
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}

