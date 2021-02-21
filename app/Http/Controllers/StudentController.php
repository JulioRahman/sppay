<?php

namespace App\Http\Controllers;

use App\Student;
use App\_Class;
use App\Payment;
use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_OPERATOR);
    }

    public function index()
    {
        $classes = _Class::all();
        $spps = Spp::all()->filter(function ($item) {
            return $item->year === date('Y', strtotime('+6 month', strtotime(date('r'))));
        });

        return view('student', [
            'classes' => $classes,
            'spps' => $spps
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'nisn' => 'required',
            'nis' => 'required',
            'student_name' => 'required',
            '__class_id' => 'required',
            'spp' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $student = new Student();
        $student->nisn = $request->input('nisn');
        $student->nis = $request->input('nis');
        $student->student_name = $request->input('student_name');
        $student->__class_id = $request->input('__class_id');
        $student->spp_id = $request->input('spp');
        $student->address = $request->input('address');
        $student->telephone_number = $request->input('telephone_number');
        $student->save();

        return response()->json([
            'error' => false,
            'student'  => $student,
        ], 200);
    }

    public function show($id)
    {
        $student = Student::find($id);
        $class = $student->class;

        return response()->json([
            'error' => false,
            'student'  => $student,
            'class'  => $class,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'nisn' => 'required',
            'nis' => 'required',
            'student_name' => 'required',
            '__class_id' => 'required',
            'spp' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $student = Student::find($id);
        $student->nisn = $request->input('nisn');
        $student->nis = $request->input('nis');
        $student->student_name = $request->input('student_name');
        $student->__class_id = $request->input('__class_id');
        $student->spp_id = $request->input('spp');
        $student->address = $request->input('address');
        $student->telephone_number = $request->input('telephone_number');
        $student->save();

        return response()->json([
            'error' => false,
            'student'  => $student,
        ], 200);
    }

    public function destroy($id)
    {
        $student = Student::destroy($id);

        return response()->json([
            'error' => false,
            'student'  => $student,
        ], 200);
    }

    public function json()
    {
        return Datatables::of(Student::with('class'))
            ->toJson();
    }

    public function detail($id)
    {
        $student = Student::with('class', 'spp')->get()->find($id);
        return view('student.detail', ['id' => $id, 'student' => $student]);
    }

    public function jsonDetail($id)
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
