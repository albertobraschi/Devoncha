<?php
/*******************************************************************************
 @name eWAY
 @type Merchant Gateway
 @author Cody Phillips
 @date November 6, 2008
 @version 1.0
 @notes For use with Blesta version 1.4.0+
*******************************************************************************/
class eway_class {
     private $eway_url;
     private $test_url = "https://www.eway.com.au/gateway/xmltest/testpage.asp"; // TEST
     private $live_url = "https://www.eway.com.au/gateway/xmlpayment.asp"; // LIVE
   
     private $username;
     private $vars;
     public static $settingFields = array("username" => "Customer ID", "testmode" => "Test Mode");

     /*
     *  Initializes the gateway
     */
     public function __construct() {
          $this->eway_url = ($this->vars['mode'] == "test" ? $this->test_url : $this->live_url);

     }

     /*
     *  We use this to set all the vars we will be using like fname, lname, phone, etc
     */
     public function set($name, $value) {
          $this->vars[$name] = $value;
     }


     /***
     * processCard()
     *
     * Populate the POST query, then send it, and store
     * the response, and finally parse the response.
     */
     public function processCard() {
          /* fill in the fields */
          $fields = array (
          'ewayCustomerID' =>  $this->vars['ewayCustomerID'],
          'ewayCustomerFirstName' => $this->vars['fname'],
          'ewayCustomerLastName' => $this->vars['lname'],
          'ewayCustomerEmail' => $this->vars['email'],
          'ewayCardHoldersName' => $this->vars['fname'] . " " . $this->vars['lname'],
          'ewayCardNumber' => $this->vars['ccno'],
          'ewayCardExpiryMonth' => substr($this->vars['ccexp'], 0, 2),
          'ewayCardExpiryYear' => substr($this->vars['ccexp'], 2, 2),
		  'ewayTotalAmount' => $this->vars['amount'], // Amount in cents (eg $1.00 = 100)
		  'ewayCustomerInvoiceDescription' => $this->vars['orderdesc'],
		  'ewayCustomerAddress' => $this->vars['address'],
          'ewayCustomerPostcode' => $this->vars['zip'],
          'ewayCustomerInvoiceDescription' => "",
          'ewayCustomerInvoiceRef' => $this->vars['iid'],
          'ewayTrxnNumber' => "",
          'ewayOption1' => "",
          'ewayOption2' => "",
          'ewayOption3' => ""
          );

          $xmlRequest = "<ewaygateway>";
          foreach($fields as $key=>$value)
                  $xmlRequest .= "<" . $key . ">" . $value . "</" . $key . ">";
 		$xmlRequest .= "</ewaygateway>";          
        
          // perform the transaction
          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, $this->eway_url); // Set the URL
	 curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_POST, 1); // Perform a POST
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
       	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
	  
	 //Log the transaction data sent to eWAY
	// $this->logData("eway", str_replace($this->vars['ccno'], "xxxx", $fields), "input", true);

          $response = curl_exec($ch);
          curl_close($ch);

          // return the parsed response
          return $this->parseResponse($response);

     }

     /***
     * parseResponse()
     *
     * This method will parse the response parameter values
     * into the respective properties.
     */
     private function parseResponse($response) {
           $xml_parser = xml_parser_create();
           xml_parse_into_struct($xml_parser,  $response, $xmlData, $index);
           $responseFields = array();
           
           foreach($xmlData as $data) {
           	if($data['level'] == 2)
           		$responseFields[strtolower($data['tag'])] = $data['value'];
				
           }
		
	  // Format the response for Blesta           
	  $eway_results=array(
	  "x_response_code" => ($responseFields['ewaytrxnstatus'] == "True" ? 1 : ($responseFields['ewaytrxnstatus'] == "False" ? 2 : 3)),
	  "x_response_reason_text" => $responseFields['ewaytrxnerror'],
	  "x_trans_id" => $responseFields['ewaytrxnnumber']);

	  // Log the formatted response from eWAY
	 //$this->logData("eway", $responseFields, "output", ($eway_results['x_response_code'] == 1 ? true : false));

           return $eway_results;
     }    
}


/*
--------------------------------------------
Test Account Numbers
--------------------------------------------
4444333322221111
*/
?>