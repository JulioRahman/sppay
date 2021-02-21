<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Payment;
use App\Role\UserRole;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->isStudent()) {
            $nisn = Student::where('user_id', '=', Auth::id())->get();
            return view('dashboard', ['id' => $nisn[0]['nisn']]);
        } else {
            $student_count = Student::count();
            $class_count = _Class::count();
            $operator_count = User::where('role', UserRole::ROLE_OPERATOR)->count();
            $payment_sum = Payment::join('spps', 'payments.spp_id', '=', 'spps.id')
                ->select(DB::raw('SUM((spps.nominal / 12) * payments.month_paid) AS total'))
                ->get();

            return view('dashboard', [
                'student_count' => $student_count,
                'class_count' => $class_count,
                'operator_count' => $operator_count,
                'payment_sum' => $payment_sum[0]['total']
            ]);
        }
    }

    public function json($id)
    {
        $iMonth = 0;
        $month = array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $years = Payment::where('student_nisn', $id)
            ->join('spps', 'payments.spp_id', '=', 'spps.id')
            ->groupBy('spps.school_year')
            ->orderBy('spps.school_year', 'DESC')
            ->select('school_year')
            ->get();

        $arrays = [];

        if (count($years) != 0) {
            for ($i = 0; $i < count($years); $i++) {
                $iMonth = 0;

                $data = Payment::where('student_nisn', $id)
                    ->join('spps', 'payments.spp_id', '=', 'spps.id')
                    ->where('spps.school_year', $years[$i]->school_year)
                    ->get();

                for ($j = 0; $j < count($data); $j++) {
                    for ($k = 0; $k < $data[$j]->month_paid; $k++) {
                        array_push($arrays, [
                            'month' => $month[$iMonth],
                            'school_year' => $data[$j]->spp->school_year,
                            'nominal_month' => $data[$j]->spp->nominal / 12,
                            'payment_date' => $data[$j]->payment_date,
                            'operator_name' => $data[$j]->operator->name,
                            'info' => '1',
                        ]);

                        $iMonth++;
                    }
                }

                $data = Student::find($id)
                    ->with('spp')
                    ->get();

                for ($j = $iMonth; $j < 12; $j++) {
                    array_push($arrays, [
                        'month' => $month[$j],
                        'school_year' => $data[0]->spp->school_year,
                        'nominal_month' => $data[0]->spp->nominal / 12,
                        'payment_date' => '',
                        'operator_name' => '',
                        'info' => '2',
                    ]);
                }
            }
        } else {
            $data = Student::find($id)
                ->with('spp')
                ->get();

            for ($i = 0; $i < 12; $i++) {
                array_push($arrays, [
                    'month' => $month[$i],
                    'school_year' => $data[0]->spp->school_year,
                    'nominal_month' => $data[0]->spp->nominal / 12,
                    'payment_date' => '',
                    'operator_name' => '',
                    'info' => '2',
                ]);
            }
        }

        return Datatables::of($arrays)
            ->toJson();
    }
}
