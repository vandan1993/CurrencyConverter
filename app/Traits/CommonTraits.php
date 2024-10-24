<?php
namespace App\Traits;

use Carbon\Carbon;

trait CommonTraits{

    public function intervalMapping(){

        return [
            "R-Y-I-M" => "Range: One Year, Interval: Monthly",
            "R-6M-I-W" => "Range: Six Months, Interval: Weekly",
            "R-M-I-D" => "Range: One Month, Interval: Daily"
        ];
    }

    public function getIntervalDates(string $range , string $requestreportdate){

        $startdate = Carbon::parse($requestreportdate);;
        $enddate = "";

        switch ($range) {
            case 'R-Y-I-M':
                # code...
                $enddate = $startdate->copy()->subYear();
                break;

            case 'R-6M-I-W':
                    # code...
                    $enddate = $startdate->copy()->subMonths(6);
                break;

            case 'R-M-I-D' :
            default:
                # code...
                $enddate = $startdate->copy()->subMonths(1);
                break;
        }

        return [
            "start_date" => $enddate->format('Y-m-d'),
            "end_date" =>  $startdate->format('Y-m-d'),
        ];
    }
}
