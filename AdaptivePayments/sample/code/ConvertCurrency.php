<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');

// # ConvertCurrency API
// Use the ConvertCurrency API operation to request the current foreign exchange (FX) rate for a specific amount and currency.
// This sample code uses AdaptivePayments PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptivepayments-sdk/php)
class ConvertCurrency
{

	public function convert(){

		$logger = new PPLoggingManager('ConvertCurrency');

		// ##ConvertCurrencyRequest
		// The ConvertCurrencyRequest message enables you to have your
		// application get an estimated exchange rate for a list of amounts.
		// This API operation does not affect PayPal balances.

		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// `CurrencyList` which takes two arguments:
		//
		// * `CurrencyCodeType` - The currency code. Allowable values are:
		// * Australian Dollar - AUD
		// * Brazilian Real - BRL
		// `Note:
		// The Real is supported as a payment currency and currency balance only
		// for Brazilian PayPal accounts.`
		// * Canadian Dollar - CAD
		// * Czech Koruna - CZK
		// * Danish Krone - DKK
		// * Euro - EUR
		// * Hong Kong Dollar - HKD
		// * Hungarian Forint - HUF
		// * Israeli New Sheqel - ILS
		// * Japanese Yen - JPY
		// * Malaysian Ringgit - MYR
		// `Note:
		// The Ringgit is supported as a payment currency and currency balance
		// only for Malaysian PayPal accounts.`
		// * Mexican Peso - MXN
		// * Norwegian Krone - NOK
		// * New Zealand Dollar - NZD
		// * Philippine Peso - PHP
		// * Polish Zloty - PLN
		// * Pound Sterling - GBP
		// * Singapore Dollar - SGD
		// * Swedish Krona - SEK
		// * Swiss Franc - CHF
		// * Taiwan New Dollar - TWD
		// * Thai Baht - THB
		// * Turkish Lira - TRY
		// `Note:
		// The Turkish Lira is supported as a payment currency and currency
		// balance only for Turkish PayPal accounts.`
		// * U.S. Dollar - USD
		// * `amount`
		$baseAmountList = new CurrencyList();
		$baseAmountList->currency[] = new CurrencyType("USD","4.00");

		// `CurrencyCodeList` which contains
		//
		// * `Currency Code` - Allowable values are:
		// * Australian Dollar - AUD
		// * Brazilian Real - BRL
		// `Note:
		// The Real is supported as a payment currency and currency balance only
		// for Brazilian PayPal accounts.`
		// * Canadian Dollar - CAD
		// * Czech Koruna - CZK
		// * Danish Krone - DKK
		// * Euro - EUR
		// * Hong Kong Dollar - HKD
		// * Hungarian Forint - HUF
		// * Israeli New Sheqel - ILS
		// * Japanese Yen - JPY
		// * Malaysian Ringgit - MYR
		// `Note:
		// The Ringgit is supported as a payment currency and currency balance
		// only for Malaysian PayPal accounts.`
		// * Mexican Peso - MXN
		// * Norwegian Krone - NOK
		// * New Zealand Dollar - NZD
		// * Philippine Peso - PHP
		// * Polish Zloty - PLN
		// * Pound Sterling - GBP
		// * Singapore Dollar - SGD
		// * Swedish Krona - SEK
		// * Swiss Franc - CHF
		// * Taiwan New Dollar - TWD
		// * Thai Baht - THB
		// * Turkish Lira - TRY
		// `Note:
		// The Turkish Lira is supported as a payment currency and currency
		// balance only for Turkish PayPal accounts.`
		// * U.S. Dollar - USD
		$convertToCurrencyList = new CurrencyCodeList();
		$convertToCurrencyList->currencyCode[] = "GBP";

		// `ConvertCurrencyRequest` which takes params:
		//
		// * `Request Envelope` - Information common to each API operation, such
		// as the language in which an error message is returned
		// * `BaseAmountList` - A list of amounts with associated currencies to
		// be converted.
		// * `ConvertToCurrencyList` - A list of currencies to convert to.
		$convertCurrencyReq = new ConvertCurrencyRequest($requestEnvelope, $baseAmountList, $convertToCurrencyList);

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptivePaymentsService();
		try {
			// ## Making API call
			// Invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->ConvertCurrency($convertCurrencyReq);

		} catch(Exception $ex) {
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if ($response->responseEnvelope->ack == "Success")
		{
			if($response->estimatedAmountTable->currencyConversionList != null && sizeof($response->estimatedAmountTable->currencyConversionList)>0){
				$currencyConversionList = $response->estimatedAmountTable->currencyConversionList;
					
				foreach($currencyConversionList as $fromCurrency){
		
					$logger->log("Amount to be Converted : ". $fromCurrency->baseAmount->amount . $fromCurrency->baseAmount->code);
					$toCurrency = $fromCurrency->currencyList->currency;
		
					foreach($toCurrency as $convertedTo){
						$logger->log("Converted amount : ". $convertedTo->amount . $convertedTo->code);
					}
				}
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

