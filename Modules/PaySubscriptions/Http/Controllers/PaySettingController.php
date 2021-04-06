<?php

namespace Modules\PaySubscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PaySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('paysubscriptions::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('paysubscriptions::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('paysubscriptions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('paysubscriptions::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function payment(Request $request)
    {
        $request_params = array (
          	'METHOD' => 'DoDirectPayment',
          	'USER' => 'laracode101_api1.gmail.com',
          	'PWD' => 'BQJBSMHVP8WCEETS',
          	'SIGNATURE' => 'AyVuUcpetZUWCXV.EHq.qRhxEb6.AChQnxfoM9w6UJXXRBh2cH1GUawh',
          	'VERSION' => '85.0',
          	'PAYMENTACTION' => 'Sale',
          	'IPADDRESS' => '127.0.0.1',
          	'CREDITCARDTYPE' => 'Visa',
          	'ACCT' => '4032032452071167',
          	'EXPDATE' => '072023',
          	'CVV2' => '123',
          	'FIRSTNAME' => 'Yang',
          	'LASTNAME' => 'Ling',
          	'STREET' => '1 Main St',
          	'CITY' => 'San Jose',
          	'STATE' => 'CA',
          	'COUNTRYCODE' => 'US',
          	'ZIP' => '95131',
          	'AMT' => '100.00',
          	'CURRENCYCODE' => 'USD',
          	'DESC' => 'Testing Payments Pro'
       );     
     
       $nvp_string = '';     
       foreach($request_params as $var => $val)
       {
          $nvp_string .= '&'.$var.'='.urlencode($val);
       }
     
       	$curl = curl_init();     
       	curl_setopt($curl, CURLOPT_VERBOSE, 0);     
       	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);     
       	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);     
       	curl_setopt($curl, CURLOPT_TIMEOUT, 30);     
       	curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');     
       	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);     
       	curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string); 

       	$result = curl_exec($curl);     
       	curl_close($curl);   

       	$data = $this->NVPToArray($result);

       	if($data['ACK'] == 'Success') {
       		# Database integration...
       		echo "Your payment was processed success.";
       	} if ($data['ACK'] == 'Failure') {
       		# Database integration...
       		echo "Your payment was declined/fail.";
       	} else {
       		echo "Something went wront please try again letter.";
       	}
    }

    public function  NVPToArray($NVPString)
    {
       $proArray = array();
       while(strlen($NVPString)) {
            // key
            $keypos= strpos($NVPString,'=');
            $keyval = substr($NVPString,0,$keypos);
            //value
            $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
            $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);

            $proArray[$keyval] = urldecode($valval);
            $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
        }
        return $proArray;
    }
}
