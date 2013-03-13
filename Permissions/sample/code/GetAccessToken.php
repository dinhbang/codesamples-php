<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # GetAccessToken API
// Use the GetAccessToken API operation to obtain an access token for a set of permissions.
// This sample code uses Permissions PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/permissions-sdk/php)
class GetAccessToken {

	public function getAT() {

		$logger = new PPLoggingManager('GetAccessToken');

		// ## GetAccessTokenRequest
		$getAccessTokenRequest = new GetAccessTokenRequest();

		// The request token from the response to RequestPermissions.
		$getAccessTokenRequest->token = "AAAAAAAXRkPjxZn6SsAN";

		// The verification code returned in the redirect from PayPal to the
		// return URL after `RequestPermissions` call
		$getAccessTokenRequest->verifier = "dAO4dbekfQGG8I0ww4cClQ";

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PermissionsService();

		try {

			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->GetAccessToken($getAccessTokenRequest);

		} catch (Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using variables in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success") {
		
			// The access token that identifies a set of permissions.
			$logger->log("Access Token : " . $response->token);
		
			// The secret associated with the access token.
			$logger->log("Token Secret : " . $response->tokenSecret);
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}
