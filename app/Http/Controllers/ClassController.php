<?php

namespace App\Http\Controllers;

use App\_Class;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
    }

    public function index()
    {
        return view('class');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'grade' => 'required',
            'name' => 'required',
            'majors' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $class = new _Class();
        $class->grade = $request->input('grade');
        $class->name = $request->input('name');
        $class->majors = $request->input('majors');
        $class->save();

        return response()->json([
            'error' => false,
            'class'  => $class,
        ], 200);
    }

    public function show($id)
    {
        $class = _Class::find($id);

        return response()->json([
            'error' => false,
            'class'  => $class,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'grade' => 'required',
            'name' => 'required',
            'majors' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $class = _Class::find($id);
        $class->grade = $request->input('grade');
        $class->name = $request->input('name');
        $class->majors = $request->input('majors');
        $class->save();

        return response()->json([
            'error' => false,
            'class'  => $class,
        ], 200);
    }

    public function destroy($id)
    {
        $class = _Class::destroy($id);

        return response()->json([
            'error' => false,
            'class'  => $class,
        ], 200);
    }

    public function json()
    {
        return Datatables::of(_Class::all())
            ->toJson();
    }
}
