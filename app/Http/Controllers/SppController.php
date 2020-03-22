<?php

namespace App\Http\Controllers;

use App\Spp;
use DataTables;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('spp');
    }

    public function store()
    {
        $spp = new Spp();
        $spp->school_year = request('schoolYear1') . "/" . request('schoolYear2');
        $spp->nominal = request('nominal');
        $spp->save();

        return redirect('/spp')->with('msg', 'Berhasil!');
    }

    public function json()
    {
        return Datatables::of(Spp::all())->toJson();
    }
}
