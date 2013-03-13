<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # RequestPermissions API
// Use the RequestPermissions API operation to request permissions to execute API operations on a PayPal account holder's behalf.
// This sample code uses Permissions PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/permissions-sdk/php)
class RequestPermissions {

	public function requestPerm() {

		$logger = new PPLoggingManager('GetAccessToken');

		// ##RequestPermissionsRequest
		// `Scope`, which can take at least 1 of the following permission
		// categories:
		//
		// * EXPRESS_CHECKOUT
		// * DIRECT_PAYMENT
		// * AUTH_CAPTURE
		// * AIR_TRAVEL
		// * TRANSACTION_SEARCH
		// * RECURRING_PAYMENTS
		// * ACCOUNT_BALANCE
		// * ENCRYPTED_WEBSITE_PAYMENTS
		// * REFUND
		// * BILLING_AGREEMENT
		// * REFERENCE_TRANSACTION
		// * MASS_PAY
		// * TRANSACTION_DETAILS
		// * NON_REFERENCED_CREDIT
		// * SETTLEMENT_CONSOLIDATION
		// * SETTLEMENT_REPORTING
		// * BUTTON_MANAGER
		// * MANAGE_PENDING_TRANSACTION_STATUS
		// * RECURRING_PAYMENT_REPORT
		// * EXTENDED_PRO_PROCESSING_REPORT
		// * EXCEPTION_PROCESSING_REPORT
		// * ACCOUNT_MANAGEMENT_PERMISSION
		// * INVOICING
		// * ACCESS_BASIC_PERSONAL_DATA
		// * ACCESS_ADVANCED_PERSONAL_DATA
		$scopeList = array();
		$scopeList[0] = "INVOICING";
		$scopeList[1] = "EXPRESS_CHECKOUT";

		// Create RequestPermissionsRequest object which takes mandatory params:
		//
		// * `Scope`
		// * `Callback` - Your callback function that specifies actions to take
		// after the account holder grants or denies the request.
		$requestPermissionsRequest = new RequestPermissionsRequest($scopeList, "http://localhost/callback");

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PermissionsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->RequestPermissions($requestPermissionsRequest);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
			// ###Redirecting to PayPal
			// Once you get the success response, user needs to redirect to
			// paypal to authorize. Construct the `redirectUrl` as follows,
			// `redirectURL=https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_grant-permission&request_token="+$response->token;`
			// Once you are done with authorization, you will be returning
			// back to `callback` url mentioned in your request. While
			// returning, PayPal will send two parameters in request:
			//
			// * `request_token`
			// * `token_verifier`
			// You have to use these values in `GetAccessToken` API call to
			// generate `AccessToken` and `TokenSecret`
		
			// A token from PayPal that enables the request to obtain permissions.
			$logger->log("Request_token : " . $response->token);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
			
	}
}
