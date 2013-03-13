<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # CreateInvoice API
// Use the CreateInvoice API operation to create a new invoice. The call includes merchant, payer, and API caller information, in addition to invoice detail. The response to the call contains an invoice ID and URL.
// This sample code uses Invoice PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/invoice-sdk/php)
class CreateInvoice {

	public function invoice() {

		$logger = new PPLoggingManager('CreateInvoice');

		// ##CreateInvoiceRequest
		// Use the CreateInvoiceRequest message to create a new invoice. The
		// merchant issuing the invoice, and the partner, if any, making the
		// call, must have a PayPal account in good standing.

		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope();
		$requestEnvelope->ErrorLanguage = "en_US";

		$invoiceItemList = array();

		// InvoiceItemType which takes mandatory params:
		//
		// * `Item Name` - SKU or name of the item.
		// * `Quantity` - Item count.
		// * `Amount` - Price of the item, in the currency specified by the
		// invoice.
		$invoiceItem = new InvoiceItemType("Item","2", "4.00");
		$invoiceItemList[0] = $invoiceItem;

		// Invoice item.
		$itemList = new InvoiceItemListType($invoiceItemList);

		// InvoiceType which takes mandatory params:
		//
		// * `Merchant Email` - Merchant email address.
		// * `Personal Email` - Payer email address.
		// * `InvoiceItemList` - List of items included in this invoice.
		// * `CurrencyCode` - Currency used for all invoice item amounts and
		// totals.
		// * `PaymentTerms` - Terms by which the invoice payment is due. It is
		// one of the following values:
		// * DueOnReceipt - Payment is due when the payer receives the invoice.
		// * DueOnDateSpecified - Payment is due on the date specified in the
		// invoice.
		// * Net10 - Payment is due 10 days from the invoice date.
		// * Net15 - Payment is due 15 days from the invoice date.
		// * Net30 - Payment is due 30 days from the invoice date.
		// * Net45 - Payment is due 45 days from the invoice date.
		$invoice = new InvoiceType("jb-us-seller@paypal.com","jbui-us-personal1@paypal.com", $itemList, "USD",
		"DueOnReceipt");

		// CreateInvoiceRequest which takes mandatory params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		// * `Invoice` - Merchant, payer, and invoice information.
		$createInvoiceRequest = new CreateInvoiceRequest($requestEnvelope, $invoice);

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new InvoiceService();

		try {

			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->CreateInvoice($createInvoiceRequest);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
		
			// ID of the created invoice.
			$logger->log("Invoice ID : " . $response->invoiceID);
		}
		
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;

	}
}
