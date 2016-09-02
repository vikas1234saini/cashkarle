<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP Wrapper for Flipkart API (unofficial)
 * GitHub: https://github.com/xaneem/flipkart-api-php
 * Demo: http://www.clusterdev.com/flipkart-api-demo
 * License: MIT License
 *
 * @author Saneem (@xaneem, xaneem@gmail.com)
 * @version 0.5
 */
class Flipkart
{
	//Affiliate ID and token are entered through the constructor
    private $affiliateId;
    private $token;
    private $response_type;

    private $api_base = 'https://affiliate-api.flipkart.net/affiliate/api/';
    private $verify_ssl   = false;

    /**
     * Obtains the values for required variables during initialization
     * @param string $affiliateId Your affiliate id.
     * @param string $token Access token for the API.
     * @param string $response_type Can be json/xml.
     * @return void
     **/
    function __construct($param)
    {
		$affiliateId 	= $param['affiliateId'];
		$token 			= $param['token'];
		$response_type	= $param['response_type'];

        $this->affiliateId 		= $affiliateId;
        $this->token 			= $token;
        $this->response_type 	= $response_type;

        //Add the affiliateId and response_type to the base URL to complete it.
        $this->api_base.= $this->affiliateId.'.'.$this->response_type;
    }

    /**
     * Calls the API directory page and returns the response.
     *
     * @return string Response from the API
     **/
    public function api_home(){
        return $this->sendRequest($this->api_base);
    }

    /**
     * Used to call URLs that are taken from the API directory.
     * Any change in the URL makes it invalid and the API refuses to respond.
     * The URLs have a timeout of ~4 hours, after which a new URL is to be 
     * taken from the API homepage.
     *
     * @return string Response from the API
     **/
    public function call_url($url){
        return json_decode($this->sendRequest($url),true);
    }

    /**
     * Sends the HTTP request using cURL.
     * 
     * @param string $url The URL for the API
	 * @param int $timeout Timeout before the request is cancelled.
     * @return string Response from the API
     **/
    private function sendRequest($url, $timeout=3600){
    	//Make sure cURL is available
    	if (function_exists('curl_init') && function_exists('curl_setopt')){
	        //The headers are required for authentication
	        $headers = array(
	            'Cache-Control: no-cache',
	            'Fk-Affiliate-Id: '.$this->affiliateId,
	            'Fk-Affiliate-Token: '.$this->token
	            );

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-ClusterDev-Flipkart/0.1');
	        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        $result = curl_exec($ch);
	        curl_close($ch);

	        return $result ? $result : false;
	    }else{
            //Cannot work without cURL
			return false;
	    }        
    }
	
    public function snapdeal_call_url($url){
        return json_decode($this->sendRequestSnapdeal($url),true);
    }

    /**
     * Sends the HTTP request using cURL.
     * 
     * @param string $url The URL for the API
	 * @param int $timeout Timeout before the request is cancelled.
     * @return string Response from the API
     **/
    private function sendRequestSnapdeal($url, $timeout=3600){
    	//Make sure cURL is available
    	if (function_exists('curl_init') && function_exists('curl_setopt')){
	        //The headers are required for authentication
	        $headers = array(
					'Snapdeal-Affiliate-Id:'.SPANDEAL_affiliateId,
					'Snapdeal-Token-Id:'.SPANDEAL_token,
					'Accept:application/json'
	            );

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        $result = curl_exec($ch);
	        curl_close($ch);

	        return $result ? $result : false;
	    }else{
            //Cannot work without cURL
			return false;
	    }        
    }
	
    public function hasoffer_call_url($offerid=''){
        return json_decode($this->sendRequestHasoffer($offerid),true);
    }

    /**
     * Sends the HTTP request using cURL.
     * 
     * @param string $url The URL for the API
	 * @param int $timeout Timeout before the request is cancelled.
     * @return string Response from the API
     **/
    private function sendRequestHasoffer($offerid,$timeout=3600){
    	//Make sure cURL is available
    	if (function_exists('curl_init') && function_exists('curl_setopt')){
			// Specify method arguments
			if($offerid!=''){
				if($offerid=='report'){
					$args = array(
						'NetworkId' => 'vcm',
						'Target' => 'Affiliate_Report',
						'Method' => 'getConversions',
						'api_key' => HASOFFERS_API_KEY,
						'fields' => array(
									'Offer.name',
									'Stat.affiliate_info1',
									'Stat.affiliate_info2',
									'Stat.ad_id',
									'Stat.refer',
									'Stat.source',
									'Stat.offer_id',
									'Stat.offer_url_id',
									'Stat.ip',
									'Stat.id',
									'Stat.sale_amount',
									'Stat.pixel_refer',
									'PayoutGroup.id',
									'PayoutGroup.name',
									'OfferUrl.name',
									'OfferUrl.id',
									'Stat.approved_payout',
									'Stat.conversion_status',
									'Stat.datetime',
									'Goal.name'
								),
								'filters' => array(
									'Stat.date' => array(
										'conditional' => 'BETWEEN',
										'values' => array(
											'2016-06-25',
											date('Y-m-d')
										)
									)
								)
					);	
				}else{
					$args = array(
						'NetworkId' => 'vcm',
						'Target' => 'Affiliate_Offer',
						'Method' => 'generateTrackingLink',
						'api_key' => HASOFFERS_API_KEY,
						'offer_id' => $offerid
					);	
				}
			}else{
				$args = array(
					'NetworkId' => 'vcm',
					'Target' => 'Affiliate_Offer',
					'Method' => 'findAll',
					'api_key' => HASOFFERS_API_KEY
				);
				
			}
			
		    $curlHandle = curl_init();
		 
			// Configure cURL request
			curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));		 
			// Make sure we can access the response when we execute the call
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
		 
			// Execute the API call
			$jsonEncodedApiResponse = curl_exec($curlHandle);
		
			// Ensure HTTP call was successful
			if($jsonEncodedApiResponse === false) {
				throw new \RuntimeException(
					'API call failed with cURL error: ' . curl_error($curlHandle)
				);
			}		 
			// Clean up the resource now that we're done with cURL
			curl_close($curlHandle);


	        return $jsonEncodedApiResponse ? $jsonEncodedApiResponse : false;
	    }else{
            //Cannot work without cURL
			return false;
	    }        
    }
	
}