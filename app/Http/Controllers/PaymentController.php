<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Payment;
use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_OPERATOR);
    }

    public function index()
    {
        $spps = Spp::all()->filter(function($item)
        {
            return $item->year === date('Y', strtotime('+6 month', strtotime(date('r'))));
        });
        return view('payment', ['spps' => $spps]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'nisn' => 'required',
            'spp' => 'required',
            'month_paid' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $payment = new Payment();
        $payment->operator_id = Auth::id();
        $payment->student_nisn = $request->input('nisn');
        $payment->spp_id = $request->input('spp');
        $payment->payment_date = now();
        $payment->month_paid = $request->input('month_paid');
        $payment->save();

        return response()->json([
            'error' => false,
            'payment'  => $payment,
        ], 200);
    }

    public function show($id)
    {
        $payment = _Class::find($id);

        return response()->json([
            'error' => false,
            'payment'  => $payment,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'grade' => 'required',
            'payment_name' => 'required',
            'majors' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $payment = _Class::find($id);
        $payment->grade = $request->input('grade');
        $payment->payment_name = $request->input('payment_name');
        $payment->majors = $request->input('majors');
        $payment->save();

        return response()->json([
            'error' => false,
            'payment'  => $payment,
        ], 200);
    }

    public function destroy($id)
    {
        $payment = _Class::destroy($id);

        return response()->json([
            'error' => false,
            'payment'  => $payment,
        ], 200);
    }

    public function json()
    {
        return datatables(DB::table('payments')
            ->join('users', 'payments.operator_id', '=', 'users.id')
            ->join('students', 'payments.student_nisn', '=', 'students.nisn')
            ->join('__classes', 'students.__class_id', '=', '__classes.id')
            ->join('spps', 'payments.spp_id', '=', 'spps.id'))
            ->toJson();
    }
}
