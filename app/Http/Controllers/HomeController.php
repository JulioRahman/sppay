<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Payment;
use App\Role\UserRole;
use App\Student;
use App\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

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
        // $student_count = Student::count();
        // $class_count = _Class::count();
        // $operator_count = User::where('role', UserRole::ROLE_OPERATOR)->count();
        // $payment_sum = Payment::all()->spp()->sum('nominal');

        // error_log(implode(' ', [
        //     'student_count' => $student_count,
        //     'class_count' => $class_count,
        //     'operator_count' => $operator_count,
        //     'payment_sum' => $payment_sum
        // ]));

        // return view('dashboard', [
        //     'student_count' => $student_count,
        //     'class_count' => $class_count,
        //     'operator_count' => $operator_count
        // ]);

        return view('dashboard');
    }
}
