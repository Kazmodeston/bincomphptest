<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\PollingUnit;
use App\Models\Ward;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Lga::where("lga_id","!=", 0)->get();
        return view("addResults", ["results" => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getPullingUnits()
    {
        $results = PollingUnit::where("lga_id","!=", 0)->get();
        return view('addResults', ["results" => $results]);
    }

    public function  getWardFromLGA(Request $request)
    {
        $results = Ward::where("lga_id", $request->lga)->get();
        return $results;
    }

    
}
