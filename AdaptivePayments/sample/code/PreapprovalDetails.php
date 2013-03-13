<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # PreapprovalDetails API
// Use the PreapprovalDetails API operation to obtain information about an agreement between you and a sender for making payments on the sender's behalf.
// This sample code uses AdaptivePayments PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptivepayments-sdk/php)
class PreapprovalDetails
{

	public function preapproveDetails()
	{
		$logger = new PPLoggingManager('PreapprovalDetails');

		// ##PreapprovaDetailslRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// `PreapprovalDetailsRequest` object which takes mandatory params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Preapproval Key` - A preapproval key that identifies the
		// preapproval for which you want to retrieve details. The preapproval
		// key is returned in the PreapprovalResponse message.
		$preapprovalDetailsRequest = new PreapprovalDetailsRequest($requestEnvelope, "PA-1KM93450LF5424305");

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptivePaymentsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->PreapprovalDetails($preapprovalDetailsRequest);

		} catch(Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success")
		{
		
			// First date for which the preapproval is valid.
			$logger->log("Starting Date : ".$response->startingDate);
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}

