<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # SearchInvoices API
// Use the SearchInvoice API operation to search an invoice.
// This sample code uses Invoice PHP SDK to make API call. You can
// the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/invoice-sdk/php)
class SearchInvoices {

	public function search() {

		$logger = new PPLoggingManager('SearchInvoices');

		// ##SearchInvoicesRequest
		// Use the SearchInvoiceRequest message to search an invoice.

		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope();
		$requestEnvelope->ErrorLanguage = "en_US";

		$parameters = new SearchParametersType();

		// Invoice amount search. It specifies the smallest amount to be
		// returned. If you pass a value for this field, you must also pass a
		// currencyCode value.
		$parameters->UpperAmount = "4.00";

		// Currency used for lower and upper amounts. It is required when you
		// specify lowerAmount or upperAmount.
		$parameters->CurrencyCode = "USD";

		// SearchInvoicesRequest which takes mandatory params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Merchant Email` - Email address of invoice creator.
		// * `SearchParameters` - Parameters constraining the search.
		// * `Page` - Page number of result set, starting with 1.
		// * `Page Size` - Number of results per page, between 1 and 100.
		$searchInvoicesRequest = new SearchInvoicesRequest($requestEnvelope, "jb-us-seller@paypal.com", $parameters,
		"1", "10");

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new InvoiceService();
		try {

			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->SearchInvoices($searchInvoicesRequest);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
		
			// Number of invoices that matched the request.
			$logger->log("Count : " . $response->count);
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;

	}
}
