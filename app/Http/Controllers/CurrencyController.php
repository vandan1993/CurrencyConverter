<?php

namespace App\Http\Controllers;

use App\Service\CurrencyApi;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public $currencyApi;

    public function __construct(CurrencyApi $currencyApi)
    {
        $this->currencyApi = $currencyApi;
    }


    public function setCurrencyCountry(){

        $returnArr = ['statusCode' => 200 , 'status' => true , 'message' => 'Success' , 'data' => []];
        $response = $this->currencyApi->listCurrency();

        if($response['status'] == true){

            $currency = $response['data']['currencies'];
            foreach($currency as $key => $value){

                Currency::updateOrCreate(
                    ['currency' => $key], // Attributes to search for
                    ['currency_name' => $value] // Values to update or set
                );
            }


        }else{
            $returnArr = ['statusCode' => 200 , 'status' => false ,'message' => 'failure' , 'data' => [$response]];
        }

        return response()->json($returnArr);

    }

}
