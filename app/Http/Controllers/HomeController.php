<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetUserCurrencyRequest;
use App\Http\Requests\SetUserReportRequest;
use App\Service\CurrencyApi;
use App\Models\Currency;
use App\Models\UserCurrencyMapping;
use App\Models\UsersReportRequest;
use App\Traits\CommonTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    use CommonTraits;


    public $currencyApi;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CurrencyApi $currencyApi)
    {
        $this->middleware('auth');
        $this->currencyApi = $currencyApi;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currecyList = Currency::select('currency','id')->where('currency' , '!=' , config('config.CL_SOURCE'))->get()->toArray();
        $userCurrency = UserCurrencyMapping::where('user_id' , Auth::user()->id)->pluck('currency_id')->toArray();
        $reportList = UsersReportRequest::where('user_id' ,  Auth::user()->id)->orderBy('report_request_time' ,'desc')->get();

        return view('home' , ["currecyList" => $currecyList , 'userCurrency' => $userCurrency , 'reportList' => $reportList]);
    }


    public function setUserCurrency(SetUserCurrencyRequest $request)
    {
        $respArr =  ['status' => true, 'message' => 'Success' , 'data' => []];
        $source = config('config.CL_SOURCE');
         // The request is validated at this point
        $validatedData = $request->validated();

        $currencyIdArr = $validatedData['currencyselect'];
        $userId = $validatedData['user_id'];

        try{
            $currencylist = Currency::whereIn('id', $currencyIdArr)->get('id')->toArray();
            if(!empty($currencylist)){

                $storeCurrencyId = UserCurrencyMapping::where('user_id', $userId)
                ->pluck('currency_id')->toArray();

                $commonValues = array_intersect($currencyIdArr, $storeCurrencyId);
                $insertArr = array_diff($currencyIdArr, $commonValues);
                $deleteArr = array_diff($storeCurrencyId, $commonValues);


                if(!empty($deleteArr)){
                    UserCurrencyMapping::where('user_id', $userId)
                    ->whereIn('currency_id',$deleteArr)->delete();
                }

                if(!empty($insertArr)){
                    $finalInsertArr = array_map(function($index) use ($userId){
                        return ['user_id' => $userId, 'currency_id' => $index , 'created_at' => now() , 'updated_at' => now()];
                    }, $insertArr);
                    UserCurrencyMapping::insert(
                        $finalInsertArr
                    );
                }
            }

            $getCurrency = UserCurrencyMapping::with(['currency' => function ($query){
                $query->select('currency','id');
            }])->where('user_id',$userId)->get();

            $currListArr = $getCurrency->pluck('currency')->pluck('currency')->toArray();
            $currListArr = array_filter($currListArr);
            asort($currListArr);
            $curStr = implode(',',$currListArr);
            $quotesData = [];

            $tempquotes = [];
            if(!empty($curStr)){
                $liveResponse  = $this->currencyApi->getLiveCurrency($curStr , $userId);
                if($liveResponse['status'] == true){
                    $tempquotes = $liveResponse['data']['quotes'] ?? [];
                }
            }

            if(!empty($tempquotes)){
                foreach($currListArr as $key => $value){
                    $quotesData[] = ['currency' => $value , 'source' => $source , 'quote' => $tempquotes[$source.$value] ];
                }
            }

            $respArr['data']['quotes'] =  $quotesData;

            return response()->json($respArr, 200);

        }catch(\Exception $e){

            $respArr = ['status' => false, 'message' => 'Unexpected Error' , 'error' => [$e->getMessage()]];
            return response()->json($respArr, 400);
        }
        //return view('dashboard.reports');

    }


    public function showReport(Request $request)
    {
        $currecyList = Currency::select('currency','id')->where('currency' , '!=' , config('config.CL_SOURCE'))->get()->toArray();
        $userId = Auth::user()->id;
        $reportList = UsersReportRequest::where('user_id' , $userId)->orderBy('report_request_time' ,'desc')->get();
        return view('userreports' , ["currecyList" => $currecyList , 'reportList' => $reportList]);

    }

    public function setUserReportRequest(SetUserReportRequest $request){

        $respArr =  ['status' => true, 'message' => 'Success' , 'data' => []];
        $source = config('config.CL_SOURCE');
         // The request is validated at this point
        $validatedData = $request->validated();

        $currencyIdArr = $validatedData['currencyselect'];
        $userId = $validatedData['user_id'];
        $report_interval =$validatedData['rangeinterval'];

        try{
            $reportName = 'ReportName-'.$report_interval.'-'.date('YmdHis').'-'.uniqid();
            $currency_name= Currency::where('id', $currencyIdArr)->first('currency')->toArray();
            UsersReportRequest::create([
                'currency' => $currency_name['currency'] ,
                'source' => $source,
                'user_id' => $userId,
                'report_name' => $reportName,
                'report_interval' => $report_interval,
                'report_request_time' => date('Y-m-d H:i:s'),
                'report_status' => 'pending'
            ]);

            return response()->json($respArr, 200);

        }catch(\Exception $e){

            $respArr = ['status' => false, 'message' => 'Unexpected Error' , 'error' => [$e->getMessage()]];
            return response()->json($respArr, 400);
        }
    }



    public function viewReport(int $reportId)
    {
        $reportData = UsersReportRequest::where('id' , $reportId)->get();
        return view('viewuserreports' , ['reportData' => $reportData , 'intervalMapping' => $this->intervalMapping() ]);
    }
}
