@php
use Carbon\Carbon;

$quotedata = $reportData[0]->quote_data;

$range_interval = $reportData[0]->report_interval;
$intarr = explode('-', $range_interval);
$label = $intervalMapping[$range_interval];
$interval = end($intarr);
$finalquote = [];
$keyIndex = $reportData[0]->source.$reportData[0]->currency;
if(!empty($quotedata)){

    $quotearr = [];
    $tempquotearr = json_decode($quotedata, true);
    foreach ($tempquotearr as $key => $val) {
        $quotearr[] = ["date" => $key , "value" =>$val[$keyIndex]];
    }

    $quotecollect = collect($quotearr);
    if($interval == 'M' || $interval == 'W'){

        $finalquote = $quotecollect->groupBy(function ($item) use ($interval) {
        $format =  ($interval == 'M') ? 'Y-m' : "Y-\WW";
            return Carbon::parse($item['date'])->format($format); // Group by year and month
        })->map(function ($group) {
            return $group->avg('value'); // avg amounts in each group
        })->toArray();
    }else{
        $finalquote = $quotecollect->pluck('value','date')->toArray();
    }

}
@endphp

@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('User View Report') }}</div>

                <div class="card-body">
                    <div class="container mt-2">
                        <div class="row">
                            <div class = "col-md-12 mb-3" id="userReportTable">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Report Name</th>
                                        <th>Source Currency</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>{{ $reportData[0]->report_name }}</td>
                                            <td>{{ $reportData[0]->source }}</td>
                                            <td>{{ $reportData[0]->currency }}</td>
                                            <td>{{ $reportData[0]->report_status }}</td>
                                        </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <canvas id="myChart"></canvas>


            <div class="card mt-4">
                <div class="card-header">{{ __('Conversation') }}</div>

                <div class="card-body">
                    <div class="container mt-2">
                        <div class="row">
                            <div class = "col-md-12 mb-3" id="userReportTable">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Date</th>
                                        <th>Conversation ({{ $reportData[0]->source }} TO {{$reportData[0]->currency }})</th>
                                    </thead>
                                    <tbody>

                                            @foreach ($finalquote as $key => $value)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                            @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
const data = {
    labels: @json(array_keys($finalquote)),
    datasets: [{
        label: "{{$label}}",
        backgroundColor: 'rgba(255, 99, 132, 0.3)',
        borderColor: 'rgb(255, 99, 132)',
        data: @json(array_values($finalquote)),
    }]
};
const config = {
    type: 'bar',
    data: data
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);
</script>
@endpush
