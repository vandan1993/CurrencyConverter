<?php

namespace App\Service;

use App\Models\Currency;
use App\Models\CurrencyApiLogs;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class CurrencyApi
{
    private $apiurl;
    private $accessToken;
    private $source;
    const ENDPOINT = '__endpoint__';

    public  function __construct(){

        $this->accessToken = config('config.CL_API_TOKEN');
        $this->apiurl = 'https://api.currencylayer.com/'.self::ENDPOINT.'?access_key=' . $this->accessToken;
        $this->source = config('config.CL_API_SOURCE');
    }



    private function baseApi(array $configuration){

        $retunrArr = ['status' => false , 'message' => 'failure' , 'data' => [] , 'error' => []];

        try {
            $url = $configuration['api_url'];
            $response = Http::get($url);
            $configuration['response_status'] = $response->status();

            if ($response->successful()) {

                $data = $response->json();
                $configuration['response'] = json_encode($data);

                if($data['success'] == 'true') {

                    $retunrArr['status'] = true;
                    $retunrArr['message'] = 'Success';
                    $retunrArr['data'] = $data;

                    $configuration['status'] = 'success';

                }else{
                    $configuration['exception'] = $data['error']['info'] ?? 'Api Error';
                    $retunrArr['error'] = $data;
                    $configuration['status'] = 'failure';

                }
            } else {

                    $configuration['exception'] = 'Unexpected error occurred';
                    $configuration['status'] = 'failure';
            }
        } catch (RequestException $e) {

            $configuration['exception'] = 'Network error:' . $e->getMessage();
            $configuration['response_status'] = 0;
            $configuration['status'] = 'failure';

        } finally {
            CurrencyApiLogs::create($configuration);
        }

        return $retunrArr;

    }


    public function listCurrency(){

        $endpoint = 'list';
        $apiurl = str_replace(self::ENDPOINT,$endpoint,$this->apiurl);

        $apiConfig = [
            'api_name' => 'List Currency Api',
            'end_point' => $endpoint,
            'api_url' => $apiurl,
            'method' => 'GET',
            'request' => json_encode([]),
            'response' => '',
            'response_status' => '',
            'exception'  => '',
            'user_id' => 0,
            'status' => 'pending'
        ];

        return $this->baseApi($apiConfig);
    }


    public function getLiveCurrency(string $currency , int $user_id){

        $endpoint = 'live';
        $apiurl = str_replace(self::ENDPOINT,$endpoint,$this->apiurl);
        if(!empty($currency)){
            $apiurl .= '&currencies='.$currency;
        }


        $apiConfig = [
            'api_name' => 'Live Currency Api',
            'end_point' => $endpoint,
            'api_url' => $apiurl,
            'method' => 'GET',
            'request' => json_encode([]),
            'response' => '',
            'response_status' => '',
            'exception'  => '',
            'user_id' => $user_id,
            'status' => 'pending'
        ];

        return $this->baseApi($apiConfig);
    }


    public function getHistoricalCurrency(string $currency , string $date ){

        $endpoint = 'historical';
        $source = $this->source;
        $apiurl = str_replace(self::ENDPOINT,$endpoint,$this->apiurl);
        if(!empty($currency)){
            $apiurl .= '&date='.$date.'&source='.$source.'&currencies='.$currency;
        }


        $apiConfig = [
            'api_name' => 'Historical Currency Api',
            'end_point' => $endpoint,
            'api_url' => $apiurl,
            'method' => 'GET',
            'request' => json_encode([]),
            'response' => '',
            'response_status' => '',
            'exception'  => '',
            'user_id' => 0,
            'status' => 'pending'
        ];

        return $this->baseApi($apiConfig);
    }

    public function getHistoricalTimeframe(array $config ){
        $endpoint = 'timeframe';
        $source = $config['source'];
        $currency = $config['currency'];
        $startdate = $config['startdate'];
        $enddate = $config['enddate'];
        $user_id = $config['user_id'];

        $apiurl = str_replace(self::ENDPOINT,$endpoint,$this->apiurl);
        if(!empty($currency)){
            $apiurl .= '&source='.$source.'&currencies='.$currency;
            $apiurl .= '&start_date='.$startdate.'&end_date='.$enddate;
        }


        $apiConfig = [
            'api_name' => 'Timeframe Currency Api',
            'end_point' => $endpoint,
            'api_url' => $apiurl,
            'method' => 'GET',
            'request' => json_encode([]),
            'response' => '',
            'response_status' => '',
            'exception'  => '',
            'user_id' => $user_id,
            'status' => 'pending'
        ];

        return $this->baseApi($apiConfig);
    }

}
