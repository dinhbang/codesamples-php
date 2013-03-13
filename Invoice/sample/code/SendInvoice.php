<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # SendInvoice API
// Use the SendInvoice API operation to send an invoice to a payer, and notify the payer of the pending invoice.
// This sample code uses Invoice PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/invoice-sdk/php)
class SendInvoice{
	
	public function send() {
	
		$logger = new PPLoggingManager('SendInvoice');
	
		// ##SendInvoiceRequest
		// Use the SendInvoiceRequest message to send an invoice to a payer, and
		// notify the payer of the pending invoice.
	
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope();
		$requestEnvelope->ErrorLanguage = "en_US";
	
		// SendInvoiceRequest which takes mandatory params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Invoice ID` - ID of the invoice to send.
		$sendInvoiceRequest = new SendInvoiceRequest($requestEnvelope, "INV2-EBLC-RUQ9-DF6Z-H86C");
	
		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new InvoiceService();
		try {
	
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->SendInvoice($sendInvoiceRequest);
	
		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
		
			// ID of the created invoice.
			$logger->log("Invoice ID : " .  $response->invoiceID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}
