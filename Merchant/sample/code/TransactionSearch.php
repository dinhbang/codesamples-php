<?php
$path = '../../lib';
set_include_path(get_include_path(). PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # TransactionSearch API
// The TransactionSearch API searches transaction history for transactions
// that meet the specified criteria.
// `Note:
// The maximum number of transactions that can be returned from a
// TransactionSearch API call is 100.`
// This sample code uses Merchant PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/merchant-sdk/php)
class TransactionSearch {

	
	public function searchTxn() {

		$logger = new PPLoggingManager('TransactionSearch');

		// ## TransactionSearchReq
		$transactionSearchReq = new TransactionSearchReq();

		// `TransactionSearchRequestType` which takes mandatory argument:
		//
		// * `Start Date` - The earliest transaction date at which to start the
		// search.
		$transactionSearchRequest = new TransactionSearchRequestType("2013-01-11T00:00:00+0530");
		$transactionSearchReq->TransactionSearchRequest =  $transactionSearchRequest;

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new PayPalAPIInterfaceServiceService();
		
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->TransactionSearch($transactionSearchReq);

		} catch (Exception $ex) {
			$logger->error("Error Message : " + $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->Ack == "Success") {
		
			// Search Results
			$txnSearchArray = $response->PaymentTransactions;
			foreach($txnSearchArray as $txn) {
				// Merchant's transaction ID.
				$logger->log("Transaction ID : " . $txn->TransactionID);
			}
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else {
			$logger->error("API Error Message : ". $response->Errors[0]->LongMessage);
		}
		return $response;
	}

}

