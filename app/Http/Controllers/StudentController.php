<?php

namespace App\Http\Controllers;

use App\Student;
use App\_Class;
use App\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $student->save();

        return response()->json([
            'error' => false,
            'student'  => $student,
        ], 200);
    }

    public function show($id)
    {
        $student = Student::find($id);
        $class = _Class::find($student->__class_id);

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
        return datatables(DB::table('students')
                ->join('__classes', 'students.__class_id', '=', '__classes.id')
                ->join('spps', 'students.spp_id', '=', 'spps.id'))
            ->toJson();
    }
}
