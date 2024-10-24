<?php

namespace App\Console\Commands;

use App\Models\UsersReportRequest;
use App\Service\CurrencyApi;
use Illuminate\Console\Command;
use App\Traits\CommonTraits;

class HistoricalCurrencyRate extends Command
{
    use CommonTraits;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historical:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Historical Rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyApi $currencyApi)
    {
        $reports = UsersReportRequest::where('report_status' , 'pending')->get()->toArray();

        foreach($reports as $key => $value){

            $dates = $this->getIntervalDates($value["report_interval"] , $value["report_request_time"]);
            $config= [
                "source" => $value["source"],
                "currency" => $value['currency'],
                "startdate" => $dates['start_date'],
                "enddate" => $dates['end_date'],
                "user_id" => $value["user_id"],
            ];

           $response =  $currencyApi->getHistoricalTimeframe($config);
           $quotes = [];
           $status = $value['report_status'];
           $reason = "";
           if($response['status'] == true){
                $quotes = $response['data']['quotes'] ?? [];
                $status = "success";
                $reason = "Report processing complete";
            }else{
                $status ="failure";
                $reason = "Issue in the api";
            }

            $updateArr = ['report_status' => $status , 'quote_data' => json_encode($quotes) ,
            'reason' => $reason , 'report_processing_time' => date('Y-m-d H:i:s')];

            UsersReportRequest::where('id' , $value['id'])->update($updateArr);
        }

        return Command::SUCCESS;
    }
}
