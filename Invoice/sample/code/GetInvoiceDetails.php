<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # GetInvoiceDetails API
// Use the GetInvoiceDetails API operation to get detailed information about an invoice.
// This sample code uses Invoice PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/invoice-sdk/php)
class GetInvoiceDetails {

	public function getDetails() {

		$logger = new PPLoggingManager('GetInvoiceDetails');

		// ##GetInvoiceDetailsRequest
		// Use the GetInvoiceDetailsRequest message to get detailed information
		// about an invoice.

		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope();
		$requestEnvelope->ErrorLanguage = "en_US";

		// GetInvoiceDetailsRequest which takes mandatory params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Invoice ID` - ID of the invoice to retrieve.
		$getInvoiceDetailsRequest = new GetInvoiceDetailsRequest($requestEnvelope, "INV2-ZC9R-X6MS-RK8H-4VKJ");

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new InvoiceService();

		try {

			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->GetInvoiceDetails($getInvoiceDetailsRequest);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
		
			// Status of the invoice searched.
			$logger->log("Status : " . $response->invoiceDetails->status);
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}
