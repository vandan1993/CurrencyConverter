@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                        <form name="currency_form" id="currency_form" method="POST" action="{{ route('setUserCurrency') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-9 mb-3">
                                    <label for="currencyselect" class="form-label">Select Max Five(5) Currencies</label>
                                    <select multiple class="form-select form-control select2" id="currencyselect"  name = "currency[]" aria-label="Default select example" data-live-search="true">

                                        @foreach ($currecyList as $key => $value)
                                        @php
                                            $selected = "";
                                            if(in_array($value['id'],$userCurrency))
                                                $selected = "selected";
                                        @endphp
                                            <option value="{{ $value['id'] }}" {{ $selected}} >{{ $value['currency'] }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="sourceCurrency" class="form-label">Source Currency</label>
                                    <input type="text" class="form-control" name="source" value="{{ config('config.CL_SOURCE') }}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                            <div class="row">
                                <div class = "col-md-12 mb-3" id="currencytable">
                                </div>
                            </div>
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
</div>
@endsection
