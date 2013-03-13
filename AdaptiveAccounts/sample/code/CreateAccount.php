<?php
$path = '../../lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('PPBootStrap.php');
// #CreateAccount API
// The CreateAccount API operation enables you to create a PayPal account on
// behalf of a third party.
// This sample code uses AdaptiveAccounts PHP SDK to make API call. You can
// download the SDKs [here](https://github.com/paypal/sdk-packages/tree/gh-pages/adaptiveaccounts-sdk/php)
class CreateAccount{

	public function createPersonalAccount(){

		// ##CreateAccountRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// The name of the person for whom the PayPal account is created, which
		//
		// contains
		// * FirstName
		// * LastName
		$name = new NameType();
		$name->firstName = "John";
		$name->lastName = "David";

		// The address to be associated with the PayPal account, which contains
		// * Street1
		// * countrycode
		// * city
		// * state
		// * postalcode
		$address = new AddressType("Ape Way", "US");
		$address->city = "Austin";
		$address->state = "TX";
		$address->postalCode= "78750";

		// Instantiating createAccountRequest with mandatory arguments:
		//
		// * requestenvelope
		// * name
		// * address
		// * preferredlanguagecode- The code indicating the language to be
		// associated with the account.
		// What value is allowed depends on the country code passed in the
		// countryCode parameter for the address.
		// For Example: United States (US)– en_US
		$createAccountRequest = new CreateAccountRequest($requestEnvelope, $name, $address, "en_US");

		// The type of account to be created. Allowable values are:
		//
		// * Personal – Personal account
		// * Premier – Premier account
		// * Business – Business account
		$createAccountRequest->accountType = "Personal";

		// The code of the country to be associated with the account.
		$createAccountRequest->citizenshipCountryCode = "US";

		// Phone Number to be associated with the account.
		$createAccountRequest->contactPhoneNumber = "5126914160";

		// The three letter code for the currency to be associated with the
		// account
		$createAccountRequest->currencyCode = "USD";

		// Email address of person for whom the PayPal account is created.
		$createAccountRequest->emailAddress = "sampleTest". rand(1, 1000)."@paypal.com";

		// This attribute determines whether a key or a URL is returned for the
		// redirect URL. Allowable value(s) currently supported:
		// Web – Returns a URL
		$createAccountRequest->registrationType = "web";

		// Used for configuration settings for the web flow
		$createAccountWebOptions = new CreateAccountWebOptionsType();
		$createAccountWebOptions->returnUrl = "http://localhost";
		$createAccountRequest->createAccountWebOptions = $createAccountWebOptions;
		
		// The URL to post instant payment notification (IPN) messages to
		// regarding account creation. This URL supersedes the IPN notification
		// URL set in the merchant profile.
		$createAccountRequest->notificationURL = "https://localhost/ipn";
		
		return $this->makeAPICall($createAccountRequest);

	}

	// ## Creating PremierAccount
	public function createPremierAccount(){
		// ##CreateAccountRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// The name of the person for whom the PayPal account is created, which
		// contains
		// * FirstName
		// * LastName
		$name = new NameType();
		$name->firstName = "John";
		$name->lastName = "David";

		// The address to be associated with the PayPal account, which contains
		//
		// * Street1
		// * countrycode
		// * city
		// * state
		// * postalcode
		$address = new AddressType("Ape Way", "US");
		$address->city = "Austin";
		$address->state = "TX";
		$address->postalCode= "78750";

		// Instantiating createAccountRequest with mandatory arguments:
		//
		// * requestenvelope
		// * name
		// * address
		// * preferredlanguagecode- The code indicating the language to be
		// associated with the account.
		// What value is allowed depends on the country code passed in the
		// countryCode parameter for the address.
		// For Example: United States (US)– en_US
		$createAccountRequest = new CreateAccountRequest($requestEnvelope, $name, $address, "en_US");

		// The type of account to be created. Allowable values are:
		//
		// * Personal – Personal account
		// * Premier – Premier account
		// * Business – Business account
		$createAccountRequest->accountType = "Premier";

		// The code of the country to be associated with the account.
		$createAccountRequest->citizenshipCountryCode = "US";

		// Phone Number to be associated with the account.
		$createAccountRequest->contactPhoneNumber = "5126914160";

		// The three letter code for the currency to be associated with the
		// account
		$createAccountRequest->currencyCode = "USD";

		// Email address of person for whom the PayPal account is created.
		$createAccountRequest->emailAddress = "sampleTest". rand(1, 1000)."@paypal.com";

		// This attribute determines whether a key or a URL is returned for the
		// redirect URL. Allowable value(s) currently supported:
		// Web – Returns a URL
		$createAccountRequest->registrationType = "web";

		// Used for configuration settings for the web flow
		$createAccountWebOptions = new CreateAccountWebOptionsType();
		$createAccountWebOptions->returnUrl = "http://localhost";
		$createAccountRequest->createAccountWebOptions = $createAccountWebOptions;
		
		// The URL to post instant payment notification (IPN) messages to
		// regarding account creation. This URL supersedes the IPN notification
		// URL set in the merchant profile.
		$createAccountRequest->notificationURL = "https://localhost/ipn";
		
		return $this->makeAPICall($createAccountRequest);
	}


	public function createBusinessAccount(){
		// ##CreateAccountRequest
		// The code for the language in which errors are returned, which must be
		// en_US.
		$requestEnvelope = new RequestEnvelope("en_US");

		// The name of the person for whom the PayPal account is created, which
		// contains
		//
		// * FirstName
		// * LastName
		$name = new NameType();
		$name->firstName = "John";
		$name->lastName = "David";

		// The address to be associated with the PayPal account, which contains
		//
		// * Street1
		// * countrycode
		// * city
		// * state
		// * postalcode
		$address = new AddressType("Ape Way", "US");
		$address->city = "Austin";
		$address->state = "TX";
		$address->postalCode= "78750";

		// Instantiating createAccountRequest with mandatory arguments:
		//
		// * requestenvelope
		// * name
		// * address
		// * preferredlanguagecode- The code indicating the language to be
		// associated with the account.
		// What value is allowed depends on the country code passed in the
		// countryCode parameter for the address.
		// For Example: United States (US)– en_US
		$createAccountRequest = new CreateAccountRequest($requestEnvelope, $name, $address, "en_US");

		// The type of account to be created. Allowable values are:
		//
		// * Personal – Personal account
		// * Premier – Premier account
		// * Business – Business account
		$createAccountRequest->accountType = "Business";

		// The code of the country to be associated with the account.
		$createAccountRequest->citizenshipCountryCode = "US";

		// Phone Number to be associated with the account.
		$createAccountRequest->contactPhoneNumber = "5126914160";

		// The three letter code for the currency to be associated with the
		// account
		$createAccountRequest->currencyCode = "USD";

		// Email address of person for whom the PayPal account is created.
		$createAccountRequest->emailAddress = "sampleTest". rand(1, 1000)."@paypal.com";

		// This attribute determines whether a key or a URL is returned for the
		// redirect URL. Allowable value(s) currently supported:
		// Web – Returns a URL
		$createAccountRequest->registrationType = "web";

		// Used for configuration settings for the web flow
		$createAccountWebOptions = new CreateAccountWebOptionsType();
		$createAccountWebOptions->returnUrl = "http://localhost";
		$createAccountRequest->createAccountWebOptions = $createAccountWebOptions;

		// The address for the business for which the PayPal account is created,
		// which contains
		//
		// * Street1
		// * countrycode
		// * city
		// * state
		// * postalcode
		$businessAddress = new AddressType("Ape Way", "US");
		$businessAddress->city = "Austin";
		$businessAddress->state = "TX";
		$businessAddress->postalCode= "78750";

		// This field is required for business accounts which takes mandatory
		// arguments:
		//
		// * Business Name - The name of the business for which the PayPal
		// account is created.
		// * Business Address
		// * Contact Phone Number
		$businessInfo = new BusinessInfoType("Toy Shop",$businessAddress,"5126914161");

		// The type of the business for which the PayPal account is created.
		// Allowable values are:
		//
		// * CORPORATION
		// * GOVERNMENT
		// * INDIVIDUAL
		// * NONPROFIT
		// * PARTNERSHIP
		// * PROPRIETORSHIP
		$businessInfo->businessType = "INDIVIDUAL";

		// The average monthly transaction volume of the business for which the
		// PayPal account is created. Required for all countries except Japan
		// and Australia.
		$businessInfo->averageMonthlyVolume = "400";

		// The average price per transaction. Required for all countries except
		// Japan and Australia.
		$businessInfo->averagePrice = "30";

		// The email address for the customer service department of the
		// business
		$businessInfo->customerServiceEmail = "customercare@toy.com";

		// Required for US accounts
		$businessInfo->customerServicePhone = "5126914162";

		// The category code for the business. state in which the business was
		// established. Required unless you specify both category and
		// subcategory. PayPal uses the industry standard Merchant Category
		// Codes.
		$businessInfo->merchantCategoryCode = "1520";

		// The date of establishment for the business. Optional for France
		// business accounts and required for business accounts in the following
		// countries: United States, United Kingdom, Canada, Germany, Spain,
		// Italy, Netherlands, Czech Republic, Sweden, and Denmark. Format needs
		// to be YYYY-MM-DD
		$businessInfo->dateOfEstablishment = "2011-12-21";

		// The percentage of online sales for the business from 0 through 100.
		// Required for business accounts in the following countries: United
		// States, Canada, United Kingdom, France, Czech Republic, New Zealand,
		// Switzerland, and Israel.
		$businessInfo->percentageRevenueFromOnline = "70";

		// The venue type for sales. Required for business accounts in all
		// countries except Czech Republic and Australia. Allowable values are:
		//
		// * WEB
		// * EBAY
		// * OTHER_MARKETPLACE
		// * OTHER
		$salesVenueType = array();
		$salesVenueType[0]="OTHER";
		$businessInfo->salesVenue = $salesVenueType;

		// A description of the sales venue. Required if salesVenue is OTHER for
		// all countries except Czech Republic and Australia.
		$businessInfo->salesVenueDesc = "Other sales venue type";

		$createAccountRequest->businessInfo = $businessInfo;
		
		// The URL to post instant payment notification (IPN) messages to
		// regarding account creation. This URL supersedes the IPN notification
		// URL set in the merchant profile.
		$createAccountRequest->notificationURL = "https://localhost/ipn";
		
		return $this->makeAPICall($createAccountRequest);

	}


	// Utility method to make API call
	private  function makeAPICall($createAccountRequest){
			
		$logger = new PPLoggingManager('CreateAccount');

		// ## Creating service wrapper object
		// Creating service wrapper object to make API call and loading
		// configuration file for your credentials and endpoint
		$service = new AdaptiveAccountsService();

		try{
				
			// ## Making API call
			// invoke the appropriate method corresponding to API in service
			// wrapper object
			$response = $service->CreateAccount($createAccountRequest);
				
		}catch(Exception $ex){
			$logger->error("Error Message : ". $ex->getMessage());
		}
		
		// ## Accessing response parameters
		// You can access the response parameters using getter methods in
		// response object as shown below
		// ### Success values
		if($response->responseEnvelope->ack == "Success"){
			$logger->log("Create account Key : ".$response->createAccountKey);
			// ### Redirection to PayPal
			// Once you get the success response, user needs to redirect to
			// PayPal to enter password for the created account. For that,
			// you have to use the redirect URL from the response, like
			// createAccountResponse.getRedirectURL();
			// Using this url,
			// redirects the user to PayPal.
		}
		// ### Error Values
		// Access error values from error list using getter methods
		else{
			$logger->error("API Error Message : ".$response->error[0]->message);
		}
		return  $response;
	}
}
