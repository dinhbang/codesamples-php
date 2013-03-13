<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # DoDirectPayment API
// The DoDirectPayment API Operation enables you to process a credit card
// payment.
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class DoDirectPayment{
	
	public function doDirectPay(){
		$logger = new PPLoggingManager('DoDirectPayment');
		
		// ## DoDirectPaymentReq
		$doDirectPaymentReq = new DoDirectPaymentReq();
		$doDirectPaymentRequestDetails = new DoDirectPaymentRequestDetailsType();
		
		// Information about the credit card to be charged.
		$creditCard = new CreditCardDetailsType();
		
		// Type of credit card. For UK, only Maestro, MasterCard, Discover, and
		// Visa are allowable. For Canada, only MasterCard and Visa are
		// allowable and Interac debit cards are not supported. It is one of the
		// following values:
		//
		// * Visa
		// * MasterCard
		// * Discover
		// * Amex
		// * Solo
		// * Switch
		// * Maestro: See note.
		// `Note:
		// If the credit card type is Maestro, you must set currencyId to GBP.
		// In addition, you must specify either StartMonth and StartYear or
		// IssueNumber.`
		$cardDetails->CreditCardType = "Visa";
		
		// Credit Card number
		$creditCard->CreditCardNumber = "4770461107194023";
		
		// ExpiryMonth of credit card
		$creditCard->ExpMonth = "12";
		
		// Expiry Year of credit card
		$creditCard->ExpYear = "2021";
		
		//Details about the owner of the credit card.
		$cardOwner = new PayerInfoType();
		
		// Email address of buyer.
		$cardOwner->Payer = "enduser_biz@gmail.com";
		$creditCard->CardOwner = $cardOwner;
		
		$doDirectPaymentRequestDetails->CreditCard = $creditCard;
		
		// Information about the payment
		$paymentDetails = new PaymentDetailsType();
		
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
		$orderTotal = new BasicAmountType("USD","4.00");
		$paymentDetails->OrderTotal = $orderTotal;
		
		//Your URL for receiving Instant Payment Notification (IPN) about this transaction. If you do not specify this value in the request, the notification URL from your Merchant Profile is used, if one exists.
		$paymentDetails->NotifyURL = "http://localhost/ipn";
		
		$doDirectPaymentRequestDetails ->PaymentDetails = $paymentDetails;
		
		// IP address of the buyer's browser.
		// `Note:
		// PayPal records this IP addresses as a means to detect possible fraud.`
		$doDirectPaymentRequestDetails->IPAddress = "127.0.0.1";
		
		$doDirectPaymentRequest = new DoDirectPaymentRequestType($doDirectPaymentRequestDetails);
		$doDirectPaymentReq->DoDirectPaymentRequest = $doDirectPaymentRequest;
		
		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->DoDirectPayment($doDirectPaymentReq);
		
		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		} 
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// Unique identifier of the transaction
			$logger->log("Transaction ID :"	. $response->TransactionID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			logger.severe("API Error Message : ". $response->Error[0]->LongMessage);
		}
		return $response;
	}
}

