<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # Preapproval API
// Use the Preapproval API operation to set up an agreement between yourself
// and a sender for making payments on the sender's behalf. You set up a
// preapprovals for a specific maximum amount over a specific period of time
// and, optionally, by any of the following constraints:
//
// * the number of payments
// * a maximum per-payment amount
// * a specific day of the week or the month
// * whether or not a PIN is required for each payment request.
// This sample code uses AdaptivePayments PHP SDK to make API call. You can
// download the SDK [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptivepayments-sdk/php)
class Preapproval
{

	public function preapprove()
	{
		$logger = new PPLoggingManager('Preapproval');

		// ##PreapprovalRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// `PreapprovalRequest` takes mandatory params:
		//
		// * `RequestEnvelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Cancel URL` - URL to redirect the sender's browser to after
		// canceling the preapproval
		// * `Currency Code` - The code for the currency in which the payment is
		// made; you can specify only one currency, regardless of the number of
		// receivers
		// * `Return URL` - URL to redirect the sender's browser to after the
		// sender has logged into PayPal and confirmed the preapproval
		// * `Starting Date` - First date for which the preapproval is valid. It
		// cannot be before today's date or after the ending date.
		$preapprovalRequest = new PreapprovalRequest($requestEnvelope, "http://localhost/cancel", "USD","http://localhost/return", "2013-12-18");
		
		// The URL to which you want all IPN messages for this preapproval to be
		// sent.
		// This URL supersedes the IPN notification URL in your profile
		$preapprovalRequest->ipnNotificationUrl = "http://localhost/ipn";
		
		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptivePaymentsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->Preapproval($preapprovalRequest);

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
			//$logger->log("Payment Status : ".$response);
			var_dump($response);
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}

