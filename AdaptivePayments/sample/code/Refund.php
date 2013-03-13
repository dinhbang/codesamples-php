<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # Refund API
// Use the Refund API operation to refund all or part of a payment.
// This sample code uses AdaptivePayments PHP SDK to make API call. You can
// download the SDK [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptivepayments-sdk/php)
class Refund
{

	public function refundTheAmt()
	{
		$logger = new PPLoggingManager('Refund');

		// ##RefundRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// `RefundRequest` which takes,
		// `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned.
		$refundRequest = new RefundRequest($requestEnvelope);

		// You must specify either,
		//
		// * `Pay Key` - The pay key that identifies the payment for which you
		// want to retrieve details. This is the pay key returned in the
		// PayResponse message.
		// * `Transaction ID` - The PayPal transaction ID associated with the
		// payment. The IPN message associated with the payment contains the
		// transaction ID.
		// `$refundRequest->transactionId`
		// * `Tracking ID` - The tracking ID that was specified for this payment
		// in the PayRequest message.
		// `$refundRequest->trackingId`
		$refundRequest->payKey = "AP-6KL026467X0532357";

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptivePaymentsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->Refund($refundRequest);

		} catch(Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success")
		{
			// List of refunds associated with the payment.
			$refundList = $response->refundInfoList->refundInfo;
		
			// Represents the refund attempt made to a receiver of a
			// PayRequest.
			foreach($refundList as $refundInfo){
				// Status of the refund. It is one of the following values:
				//
				// * REFUNDED - Refund successfully completed
				// * REFUNDED_PENDING - Refund awaiting transfer of funds; for
				// example, a refund paid by eCheck.
				// * NOT_PAID - Payment was never made; therefore, it cannot
				// be refunded.
				// * ALREADY_REVERSED_OR_REFUNDED - Request rejected because
				// the refund was already made, or the payment was reversed
				// prior to this request.
				// * NO_API_ACCESS_TO_RECEIVER - Request cannot be completed
				// because you do not have third-party access from the
				// receiver to make the refund.
				// * REFUND_NOT_ALLOWED - Refund is not allowed.
				// * INSUFFICIENT_BALANCE - Request rejected because the
				// receiver from which the refund is to be paid does not
				// have sufficient funds or the funding source cannot be
				// used to make a refund.
				// * AMOUNT_EXCEEDS_REFUNDABLE - Request rejected because you
				// attempted to refund more than the remaining amount of the
				// payment; call the PaymentDetails API operation to
				// determine the amount already refunded.
				// * PREVIOUS_REFUND_PENDING - Request rejected because a
				// refund is currently pending for this part of the payment
				// * NOT_PROCESSED - Request rejected because it cannot be
				// processed at this time
				// * REFUND_ERROR - Request rejected because of an internal
				// error
				// * PREVIOUS_REFUND_ERROR - Request rejected because another
				// part of this refund caused an internal error.
				$logger->log("Refund Status : " .$refundInfo->refundStatus);
			}
		
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return $response;
	}
}

