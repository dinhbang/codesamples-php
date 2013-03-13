<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # SetExpressCheckout API
// The SetExpressCheckout API operation initiates an Express Checkout
// transaction.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class SetExpressCheckout {


	public function setEC() {

		$logger = new PPLoggingManager('SetExpressCheckout');

		// ## SetExpressCheckoutReq
		$setExpressCheckoutRequestDetails = new SetExpressCheckoutRequestDetailsType();

		// URL to which the buyer's browser is returned after choosing to pay
		// with PayPal. For digital goods, you must add JavaScript to this page
		// to close the in-context experience.
		// `Note:
		// PayPal recommends that the value be the final review page on which
		// the buyer confirms the order and payment or billing agreement.`
		$setExpressCheckoutRequestDetails->ReturnURL = "http://localhost/return";

		// URL to which the buyer is returned if the buyer does not approve the
		// use of PayPal to pay you. For digital goods, you must add JavaScript
		// to this page to close the in-context experience.
		// `Note:
		// PayPal recommends that the value be the original page on which the
		// buyer chose to pay with PayPal or establish a billing agreement.`
		$setExpressCheckoutRequestDetails->CancelURL = "http://localhost/cancel";

		// ### Payment Information
		// list of information about the payment
		$paymentDetailsArray = array();

		// information about the first payment
		$paymentDetails1 = new PaymentDetailsType();

		// Total cost of the transaction to the buyer. If shipping cost and tax
		// charges are known, include them in this value. If not, this value
		// should be the current sub-total of the order.
		//
		// If the transaction includes one or more one-time purchases, this field must be equal to
		// the sum of the purchases. Set this field to 0 if the transaction does
		// not include a one-time purchase such as when you set up a billing
		// agreement for a recurring payment that is not immediately charged.
		// When the field is set to 0, purchase-specific fields are ignored.
		//
		// * `Currency Code` - You must set the currencyID attribute to one of the
		// 3-character currency codes for any of the supported PayPal
		// currencies.
		// * `Amount`
		$orderTotal1 = new BasicAmountType("USD","2.00");
		$paymentDetails1->OrderTotal = $orderTotal1;

		// How you want to obtain payment. When implementing parallel payments,
		// this field is required and must be set to `Order`. When implementing
		// digital goods, this field is required and must be set to `Sale`. If the
		// transaction does not include a one-time purchase, this field is
		// ignored. It is one of the following values:
		//
		// * `Sale` - This is a final sale for which you are requesting payment
		// (default).
		// * `Authorization` - This payment is a basic authorization subject to
		// settlement with PayPal Authorization and Capture.
		// * `Order` - This payment is an order authorization subject to
		// settlement with PayPal Authorization and Capture.
		// `Note:
		// You cannot set this field to Sale in SetExpressCheckout request and
		// then change the value to Authorization or Order in the
		// DoExpressCheckoutPayment request. If you set the field to
		// Authorization or Order in SetExpressCheckout, you may set the field
		// to Sale.`
		$paymentDetails1->PaymentAction = "Order";

		// Unique identifier for the merchant. For parallel payments, this field
		// is required and must contain the Payer Id or the email address of the
		// merchant.
		$sellerDetails1 = new SellerDetailsType();
		$sellerDetails1->PayPalAccountID = "jb-us-seller@paypal.com";
		$paymentDetails1->SellerDetails = $sellerDetails1;

		// A unique identifier of the specific payment request, which is
		// required for parallel payments.
		$paymentDetails1->PaymentRequestID = "PaymentRequest1";

		// `Address` to which the order is shipped, which takes mandatory params:
		//
		// * `Street Name`
		// * `City`
		// * `State`
		// * `Country`
		// * `Postal Code`
		$shipToAddress1 = new AddressType();
		$shipToAddress1->Street1 = "Ape Way";
		$shipToAddress1->CityName = "Austin";
		$shipToAddress1->StateOrProvince = "TX";
		$shipToAddress1->Country = "US";
		$shipToAddress1->PostalCode = "78750";

		// Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
		$paymentDetails1->NotifyURL = "http://localhost/ipn";

		$paymentDetails1->ShipToAddress = $shipToAddress1;

		// information about the second payment
		$paymentDetails2 = new PaymentDetailsType();
		// Total cost of the transaction to the buyer. If shipping cost and tax
		// charges are known, include them in this value. If not, this value
		// should be the current sub-total of the order.
		//
		// If the transaction includes one or more one-time purchases, this field must be equal to
		// the sum of the purchases. Set this field to 0 if the transaction does
		// not include a one-time purchase such as when you set up a billing
		// agreement for a recurring payment that is not immediately charged.
		// When the field is set to 0, purchase-specific fields are ignored.
		//
		// * `Currency Code` - You must set the currencyID attribute to one of the
		// 3-character currency codes for any of the supported PayPal
		// currencies.
		// * `Amount`
		$orderTotal2 = new BasicAmountType("USD","4.00");
		$paymentDetails2->OrderTotal = $orderTotal2;

		// How you want to obtain payment. When implementing parallel payments,
		// this field is required and must be set to `Order`. When implementing
		// digital goods, this field is required and must be set to `Sale`. If the
		// transaction does not include a one-time purchase, this field is
		// ignored. It is one of the following values:
		//
		// * `Sale` - This is a final sale for which you are requesting payment
		// (default).
		// * `Authorization` - This payment is a basic authorization subject to
		// settlement with PayPal Authorization and Capture.
		// * `Order` - This payment is an order authorization subject to
		// settlement with PayPal Authorization and Capture.
		// `Note:
		// You cannot set this field to Sale in SetExpressCheckout request and
		// then change the value to Authorization or Order in the
		// DoExpressCheckoutPayment request. If you set the field to
		// Authorization or Order in SetExpressCheckout, you may set the field
		// to Sale.`
		$paymentDetails2->PaymentAction = "Order";

		// Unique identifier for the merchant. For parallel payments, this field
		// is required and must contain the Payer Id or the email address of the
		// merchant.
		$sellerDetails2 = new SellerDetailsType();
		$sellerDetails2->PayPalAccountID = "jb-us-seller@paypal.com";
		$paymentDetails2->SellerDetails = $sellerDetails2;

		// A unique identifier of the specific payment request, which is
		// required for parallel payments.
		$paymentDetails2->PaymentRequestID = "PaymentRequest2";

		// `Address` to which the order is shipped, which takes mandatory params:
		//
		// * `Street Name`
		// * `City`
		// * `State`
		// * `Country`
		// * `Postal Code`
		$shipToAddress2 = new AddressType();
		$shipToAddress2->Street1 = "Ape Way";
		$shipToAddress2->CityName = "Austin";
		$shipToAddress2->StateOrProvince = "TX";
		$shipToAddress2->Country = "US";
		$shipToAddress2->PostalCode = "78750";

		// Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
		$paymentDetails2->NotifyURL = "http://localhost/ipn";

		$paymentDetails2->ShipToAddress = $shipToAddress2;

		$paymentDetailsArray[0] = $paymentDetails1;
		$paymentDetailsArray[1] = $paymentDetails2;

		$setExpressCheckoutRequestDetails->PaymentDetails = $paymentDetailsArray;

		$setExpressCheckoutReq = new SetExpressCheckoutReq();
		$setExpressCheckoutRequest = new SetExpressCheckoutRequestType($setExpressCheckoutRequestDetails);

		$setExpressCheckoutReq->SetExpressCheckoutRequest = $setExpressCheckoutRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();

		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->SetExpressCheckout($setExpressCheckoutReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// ### Redirecting to PayPal for authorization
			// Once you get the "Success" response, needs to authorise the
			// transaction by making buyer to login into PayPal. For that,
			// need to construct redirect url using EC token from response.
			// For example,
			// `redirectURL="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=". $response->Token();`
		
			// Express Checkout Token
			$logger->log("EC Token:" . $response->Token);
				
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;

	}
}
