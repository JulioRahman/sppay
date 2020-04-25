<?php

namespace App\Http\Controllers;

use App\Spp;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SppController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('check_user_role:' . \App\Role\UserRole::ROLE_ADMIN);
    }

    public function index()
    {
        return view('spp');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'school_year' => 'required',
            'nominal' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $spp = new Spp();
        $spp->school_year = $request->input('school_year');
        $spp->nominal = $request->input('nominal');
        $spp->save();

        return response()->json([
            'error' => false,
            'spp'  => $spp,
        ], 200);
    }

    public function show($id)
    {
        $spp = Spp::find($id);

        return response()->json([
            'error' => false,
            'spp'  => $spp,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'school_year' => 'required',
            'nominal' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $spp = Spp::find($id);
        $spp->school_year = $request->input('school_year');
        $spp->nominal = $request->input('nominal');
        $spp->save();

        return response()->json([
            'error' => false,
            'spp'  => $spp,
        ], 200);
    }

    public function destroy($id)
    {
        $spp = Spp::destroy($id);

        return response()->json([
            'error' => false,
            'spp'  => $spp,
        ], 200);
    }

    public function json()
    {
        return Datatables::of(Spp::all())
            ->toJson();
    }
}
