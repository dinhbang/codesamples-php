<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');


// # CreateRecurringPaymentsProfile API
// The CreateRecurringPaymentsProfile API operation creates a recurring
// payments profile.
// You must invoke the CreateRecurringPaymentsProfile API operation for each
// profile you want to create. The API operation creates a profile and an
// associated billing agreement.
// `Note:
// There is a one-to-one correspondence between billing agreements and
// recurring payments profiles. To associate a recurring payments profile
// with its billing agreement, you must ensure that the description in the
// recurring payments profile matches the description of a billing
// agreement. For version 54.0 and later, use SetExpressCheckout to initiate
// creation of a billing agreement.`
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class CreateRecurringPaymentProfile{
	
	public function createRecurringProfile(){
		$logger = new PPLoggingManager('CreateRecurringPaymentProfile');
		
		// ## CreateRecurringPaymentsProfileReq
		$createRPProfileReq = new CreateRecurringPaymentsProfileReq();
		$createRPProfileRequestType = new CreateRecurringPaymentsProfileRequestType();
		
		// You can include up to 10 recurring payments profiles per request. The
		// order of the profile details must match the order of the billing
		// agreement details specified in the SetExpressCheckout request which
		// takes mandatory argument:
		//
		// * `billing start date` - The date when billing for this profile begins.
		// `Note:
		// The profile may take up to 24 hours for activation.`
		$RPProfileDetails = new RecurringPaymentsProfileDetailsType("2013-12-31T13:01:19+00:00");
		
		// Billing amount for each billing cycle during this payment period.
		// This amount does not include shipping and tax amounts.
		// `Note:
		// All amounts in the CreateRecurringPaymentsProfile request must have
		// the same currency.`
		$billingAmount = new BasicAmountType("USD", "3.00");
		
		// Regular payment period for this schedule which takes mandatory
		// params:
		//
		// * `Billing Period` - Unit for billing during this subscription period. It is one of the
		// following values:
		// * Day
		// * Week
		// * SemiMonth
		// * Month
		// * Year
		// For SemiMonth, billing is done on the 1st and 15th of each month.
		// `Note:
		// The combination of BillingPeriod and BillingFrequency cannot exceed
		// one year.`
		// * `Billing Frequency` - Number of billing periods that make up one billing cycle.
		// The combination of billing frequency and billing period must be less
		// than or equal to one year. For example, if the billing cycle is
		// Month, the maximum value for billing frequency is 12. Similarly, if
		// the billing cycle is Week, the maximum value for billing frequency is
		// 52.
		// `Note:
		// If the billing period is SemiMonth, the billing frequency must be 1.`
		// * `Billing Amount`
		$paymentPeriod = new BillingPeriodDetailsType("Day","5",$billingAmount);
		
		// Describes the recurring payments schedule, including the regular
		// payment period, whether there is a trial period, and the number of
		// payments that can fail before a profile is suspended which takes
		// mandatory params:
		//
		// * `Description` - Description of the recurring payment.
		// `Note:
		// You must ensure that this field matches the corresponding billing
		// agreement description included in the SetExpressCheckout request.`
		// * `Payment Period`
		$scheduleDetails = new ScheduleDetailsType("description", $paymentPeriod);
		
		// `CreateRecurringPaymentsProfileRequestDetailsType` which takes
		// mandatory params:
		//
		// * `Recurring Payments Profile Details`
		// * `Schedule Details`
		$createRecurringPaymentsProfileRequestDetails = new CreateRecurringPaymentsProfileRequestDetailsType(
		$RPProfileDetails, $scheduleDetails);
		
		// Either EC token or a credit card number is required.If you include
		// both token and credit card number, the token is used and credit card number is
		// ignored
		// In case of setting EC token,
		// `createRecurringPaymentsProfileRequestDetails.setToken("EC-5KH01765D1724703R");`
		// A timestamped token, the value of which was returned in the response
		// to the first call to SetExpressCheckout. Call
		// CreateRecurringPaymentsProfile once for each billing
		// agreement included in SetExpressCheckout request and use the same
		// token for each call. Each CreateRecurringPaymentsProfile request
		// creates a single recurring payments profile.
		// `Note:
		// Tokens expire after approximately 3 hours.`
		
		// Credit card information for recurring payments using direct payments.
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
		$creditCard->CreditCardType = "Visa";
		
		// Credit Card Number
		$creditCard->CreditCardNumber = "4442662639546634";
		
		// Credit Card Expiration Month
		$creditCard->ExpMonth = "12";
		
		// Credit Card Expiration Year
		$creditCard->ExpYear = "2016";
		
		
		$createRecurringPaymentsProfileRequestDetails->CreditCard = $creditCard;
		
		$createRPProfileRequestType->CreateRecurringPaymentsProfileRequestDetails = $createRecurringPaymentsProfileRequestDetails;
		
		$createRPProfileReq->CreateRecurringPaymentsProfileRequest = $createRPProfileRequestType; 
		
		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		
		try{
			
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->CreateRecurringPaymentsProfile($createRPProfileReq);
			
		}catch(Exception $ex){
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if($response->Ack == "Success"){
		
			// A unique identifier for future reference to the details of
			// this recurring payment.
			$logger->log("Profile ID: ". $response->CreateRecurringPaymentsProfileResponseDetails->ProfileID);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->Errors[0]->LongMessage);
		}
		return $response;
	}
}

