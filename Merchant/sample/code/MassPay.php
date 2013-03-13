<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # MassPay API
// The MassPay API operation makes a payment to one or more PayPal account
// holders.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class MassPay {

	public function payMass() {

		$logger = new PPLoggingManager('MassPay');

		// ## MassPayReq
		// Details of each payment.
		// `Note:
		// A single MassPayRequest can include up to 250 MassPayItems.`
		$massPayReq = new MassPayReq();
		$massPayItemArray = array();

		// `Amount` for the payment which contains
		//
		// * `Currency Code`
		// * `Amount`
		$amount1 = new BasicAmountType("USD","4.00");
		$massPayRequestItem1 = new MassPayRequestItemType($amount1);

		// Email Address of receiver
		$massPayRequestItem1->ReceiverEmail = "abc@paypal.com";

		// `Amount` for the payment which contains
		//
		// * `Currency Code`
		// * `Amount`
		$amount2 = new BasicAmountType("USD","3.00");
		$massPayRequestItem2 = new MassPayRequestItemType($amount2);

		// Email Address of receiver
		$massPayRequestItem2->ReceiverEmail = "xyz@paypal.com";

		// `Amount` for the payment which contains
		//
		// * `Currency Code`
		// * `Amount`
		$amount3 = new BasicAmountType("USD","7.00");
		$massPayRequestItem3 = new MassPayRequestItemType($amount3);

		// Email Address of receiver
		$massPayRequestItem3->ReceiverEmail = "def@paypal.com";
		
		$massPayItemArray[0] = $massPayRequestItem2;
		$massPayItemArray[1] = $massPayRequestItem1;
		$massPayItemArray[2] = $massPayRequestItem3;
		
		$massPayRequest = new MassPayRequestType($massPayItemArray);
		$massPayReq->MassPayRequest = $massPayRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->MassPay($massPayReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
			$logger->log("Mass Pay successful");
		}
		// ### Error Values
		// Access error values from error list using getter methods
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

