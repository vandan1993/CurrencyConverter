@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('User Reports') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-success"  id="successMessage" role="alert" style="display:none;">
                    </div>

                    <div class="alert alert-danger"  id="errorMessage" role="alert" style="display:none;">
                    </div>


                    <div class="container mt-2">
                        <form name="user_report_form" id="user_report_form" method="POST" action="{{ route('setUserReportRequest') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="reportcurrencyselect" class="form-label">Select Currency </label>
                                    <select class="form-select select2" id="reportcurrencyselect"  name = "currency" placeholder ="Select Report">
                                        <option value=""  selected>Select an option</option>
                                        @foreach ($currecyList as $key => $value)
                                            <option value="{{ $value['id'] }}" >{{ $value['currency'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="sourceCurrency" class="form-label">Source Currency</label>
                                    <input type="text" class="form-control" id="reportsource" name="source" value="{{ config('config.CL_SOURCE') }}" readonly>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="rangeinterval" class="form-label">Range - Interval</label>
                                    <select class="form-select" id="rangeinterval"  name = "rangeinterval" placeholder ="Select Range-Interval">
                                        <option value=""  selected>Select an option</option>
                                        <option value="R-Y-I-M">Range: One Year, Interval: Monthly</option>
                                        <option value="R-6M-I-W">Range: Six Months, Interval: Weekly</option>
                                        <option value="R-M-I-D">Range: One Month, Interval: Daily</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary">Request</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('User Reports List') }}</div>

                <div class="card-body">
                    <div class="container mt-2">
                        <div class="row">
                            <div class = "col-md-12 mb-3" id="userReportTable">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Report Name</th>
                                        <th>Interval</th>
                                        <th>Source Currency</th>
                                        <th>Currency</th>
                                        <th>Request Time</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($reportList  as $key => $value)
                                        <tr>
                                            <td>{{ $value->report_name }}</td>
                                            <td>{{ $value->report_interval }}</td>
                                            <td>{{ $value->source }}</td>
                                            <td>{{ $value->currency }}</td>
                                            <td>{{ $value->report_request_time }}</td>
                                            <td>{{ $value->report_status }}</td>
                                            <td>
                                                <a href="{{ route('viewuserreport' , ['id' => $value->id])}}">View</a>
                                            </td>
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
@endsection
