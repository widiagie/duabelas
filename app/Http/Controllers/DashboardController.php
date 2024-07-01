<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FinancialReport;
use App\Models\BudgetLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(){
        $today = new DateTime();
        $thisMonthInfo = date("F Y");
        $thisMonth = date("m");
        $thisYear = date("Y");

        //get all posts from database
        $reports = FinancialReport::select('fr_id','fr_type', 'fr_item', 'fr_date', 'fr_balance', 'fr_created_at')
            ->where(['fr_type' => 'D'])
            ->where('fr_date', 'like', $thisYear. '-' . $thisMonth . '-%')
            ->orderBy('fr_date', 'DESC')
            ->paginate(7);

        return Inertia::render('Dashboard/Index', [
            'todayDate' => $today->format('l, j F, Y - H:i:s'),
            'thisMonth' => $thisMonthInfo,
            'reports'   => $reports
        ]);
    }

    // public function data(Request $request){
    //     $dateFormat = $request->selected_date;
    //     $thisDate = Carbon::parse($request->selected_date);
    //     $thisDate = $thisDate->translatedFormat('F Y');
    //     $thisDate = ($dateFormat) ? $thisDate : date("F Y");

    //     $thisMonth = date("m");
    //     $thisYear = date("Y");

    //     $query = FinancialReport::select('fr_id','fr_type', 'fr_item', 'fr_date', 'fr_balance', 'fr_created_at')
    //         ->where(['fr_type' => 'D'])
    //         ->orderBy('fr_date', 'DESC');

    //     // Filter by selected date if provided
    //     if ($request->has('selected_date') && $request->selected_date != '') {
    //         $query->where('fr_date', 'like', $dateFormat . '-%');
    //         $cost = FinancialReport::where('fr_date', 'like', $dateFormat . '-%')
    //             ->where('fr_type', 'D')
    //             ->sum('fr_balance');

    //         $dailyFund = BudgetLog::where('bl_date', 'like', $dateFormat . '-%')
    //             ->where('bl_type', 'D')
    //             ->sum('bl_amount');

    //         $monthlyFund = BudgetLog::where('bl_date', 'like', $dateFormat . '-%')
    //             ->where('bl_type', 'M')
    //             ->sum('bl_amount');

    //         $dateParts = explode("-", $dateFormat);
    //         $averageDailyBalance = $this->averageDailyBalance($dateParts[1], $dateParts[0]);
    //     } else {
    //         // Default filter for the current month
    //         $query->where('fr_date', 'like', $thisYear. '-' . $thisMonth . '-%');
    //         $cost = FinancialReport::where('fr_date', 'like', $thisYear . '-' . $thisMonth . '-%')
    //             ->where('fr_type', 'D')
    //             ->sum('fr_balance');

    //         $dailyFund = BudgetLog::where('bl_date', 'like', $thisYear . '-' . $thisMonth . '-%')
    //             ->where('bl_type', 'D')
    //             ->sum('bl_amount');

    //         $monthlyFund = BudgetLog::where('bl_date', 'like', $thisYear . '-' . $thisMonth . '-%')
    //             ->where('bl_type', 'M')
    //             ->sum('bl_amount');

    //         $averageDailyBalance = $this->averageDailyBalance($thisMonth, $thisYear);
    //     }

    //     if ($request->has('search') && $request->search != '') {
    //         $search = $request->search;
    //         $query->where(function($query) use ($search) {
    //             $query->where('fr_item', 'like', '%' . $search . '%')
    //                   ->orWhere('fr_balance', 'like', '%' . $search . '%')
    //                   ->orWhere('fr_date', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $balance = (int)$dailyFund - (int)$cost;
    //     $averageDailyBalance = number_format($averageDailyBalance['average_daily_balance'], 0, ",", ".");
    //     $data = $query->paginate(31);

    //     return response()->json([
    //         'data' => view('finance.data_table', compact('data'))->render(),
    //         'pagination' => (string) $data->links(),
    //         'thisDate' => $thisDate,
    //         'totalCostPerMonth' => number_format($cost, 0, ",", "."),
    //         'balance' => number_format($balance, 0, ",", "."),
    //         'dailyFund' => number_format($dailyFund, 0, ",", "."),
    //         'monthlyFund' => number_format($monthlyFund, 0, ",", "."),
    //         'averageDailyBalance' => $averageDailyBalance
    //     ]);
    // }

    // public function input(){
    //     $form = view("finance.data_input");
    //     $darr=array('data'=>''.$form.'');
    //     return response()->json($darr);
    // }

    // public function create(Request $request)
    // {
    //     $postall = $request->all();
    //     $dateFormat = Carbon::parse($request->fr_date);
    //     $dateFormat = $dateFormat->translatedFormat('Y-m-d');

    //     $inputclear = \Arr::except([
    //         'fr_type' => $request->fr_type,
    //         'fr_item' => $request->fr_item,
    //         'fr_date' => $dateFormat,
    //         'fr_balance' => $request->fr_balance,
    //         'fr_created_at' => now(),
    //         'fr_created_by' => Auth::user()->id,
    //     ], array('_token', '_method'));

    //     $validator = Validator::make($postall, [
    //         'fr_type' => 'required',
    //         'fr_item' => 'required',
    //         'fr_date' => 'required',
    //         'fr_balance' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'info' => "Please, Fill all Fields!"
    //         ], 201);
    //     }

    //     $post = FinancialReport::create($inputclear);
    //     return response()->json([
    //         'status' => true,
    //         'info' => 'Data item added!'
    //     ], 201);
    // }

    // public function edit(Request $request)
    // {
    //     $where = array('fr_id' => $request->input('id'));
    //     $post  = FinancialReport::where($where)->first();

    //     $form = view("finance.data_edit", ['data' => $post]);
    //     $darr=array('data'=>''.$form.'');
    //     return response()->json($darr);
    // }

    // public function update(Request $request)
    // {
    //     $postall = $request->all();
    //     $dateFormat = Carbon::parse($request->fr_date);
    //     $dateFormat = $dateFormat->translatedFormat('Y-m-d');

    //     $inputclear = \Arr::except([
    //         'fr_type' => $request->fr_type,
    //         'fr_item' => $request->fr_item,
    //         'fr_date' => $dateFormat,
    //         'fr_balance' => $request->fr_balance,
    //         'fr_updated_at' => now(),
    //         'fr_updated_by' => Auth::user()->id,
    //     ], array('_token', '_method'));
    //     $id = $request->input('id');

    //     $validator = Validator::make($postall, [
    //         'fr_type' => 'required',
    //         'fr_item' => 'required',
    //         'fr_date' => 'required',
    //         'fr_balance' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'info' => "Please, Fill all Fields!"
    //         ], 201);
    //     }

    //     FinancialReport::where('fr_id', $id)->update($inputclear);
    //     return response()->json([
    //         'status' => true,
    //         'info' => "Data item has been changes!"
    //     ], 201);
    // }

    // public function destroy($id)
    // {
    //     FinancialReport::where('fr_id', $id)->delete();
    //     return response()->json([
    //         'status' => true,
    //         'info' => "Data item deleted!"
    //     ], 201);
    // }

    // private function averageDailyBalance($month, $year)
    // {
    //     // Dapatkan data dari bulan dan tahun tertentu
    //     $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    //     $endOfMonth = $startOfMonth->copy()->endOfMonth();

    //     $dailyBalances = FinancialReport::selectRaw('DATE(fr_date) as date, SUM(fr_balance) as total_balance')
    //         ->whereBetween('fr_date', [$startOfMonth, $endOfMonth])
    //         ->groupBy('date')
    //         ->get();

    //     // Hitung jumlah hari dan total balance
    //     $totalDays = $dailyBalances->count();
    //     $totalBalance = $dailyBalances->sum('total_balance');

    //     // Hitung rata-rata
    //     $averageDailyBalance = ($totalDays > 0) ? $totalBalance / $totalDays : 0;

    //     return [
    //         'average_daily_balance' => $averageDailyBalance,
    //         'total_days' => $totalDays,
    //         'total_balance' => $totalBalance,
    //     ];
    // }

}
