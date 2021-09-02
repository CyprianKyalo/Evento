<?php

namespace App\Http\Controllers\Payments\Mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function index() {
        return view('daraja');
    }

    public function getAccessToken() {
    	$url = env('MPESA_ENV') == 0 
    	? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' 
    	: 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    	//initialize curl
    	$curl = curl_init($url);
    	curl_setopt_array($curl, array(
    		CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'],
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_HEADER => false,
    		CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY'). ':' . env('MPESA_CONSUMER_SECRET')
    	));

    	$response = json_decode(curl_exec($curl));

    	curl_close($curl);

    	return $response->access_token;
    }

    public function registerURLS() {
    	$url = env('MPESA_ENV') == 0
    	? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
    	: 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

    	$body = array(
    		'ShortCode' => env('MPESA_SHORTCODE'),
    		'ResponseType' => 'Completed',
    		'ConfirmationURL' => env('MPESA_TEST_URL') . '/api/confirmation',
    		'ValidationURL' => env('MPESA_TEST_URL') . '/api/validation'
    	);

    	$response = $this->makeHttp($url, $body);

    	return $response;
    }

    public function simulateTransaction(Request $request) {
    	$body = array(
    		'ShortCode' => env('MPESA_SHORTCODE'),
    		'Msisdn' => '254748389666',
    		'Amount' => $request->amount,
    		'BillRefNumber' => $request->account,
    		'CommandID' => 'CustomerPayBillOnline'
    	);

    	$url = env('MPESA_ENV') == 0
    	? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
    	: 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    	$response = $this->makeHttp($url, $body);

    	return $response;
    }

    public function makeHttp($url, $body) {
	   	$curl = curl_init();

	   	curl_setopt_array($curl, array(
	   		CURLOPT_URL => $url,
	   		CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization:Bearer ' . $this->getAccessToken()),
	   		CURLOPT_RETURNTRANSFER => true,
	   		CURLOPT_POST => true,
	   		CURLOPT_POSTFIELDS => json_encode($body)
	   	));

		$curl_response = curl_exec($curl);
		curl_close($curl);

		return $curl_response;
    }
}
