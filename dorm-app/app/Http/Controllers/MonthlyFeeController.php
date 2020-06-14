<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthlyFee;

class MonthlyFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MonthlyFee::orderBy("year", "desc")->orderBy("month", "desc")->get();
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
     * Store a newly created monthly fee in the storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fee = MonthlyFee::create([
            "year" => $request->year,
            "month" => $request->month,
            "closed_at" => $request->closed_at,
            "persons_before_deduction" => $request->persons_before_deduction,
            "persons_after_deduction" => $request->persons_after_deduction,
            "total_amount" => $request->total_amount,
            "fee_amount" => $request->fee_amount
        ]);
        $fee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the existing monthly fee details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_id)
    {
        $fee = MonthlyFee::find($fee_id);
        $fee->total_amount = $request->total_amount;
        $fee->persons = $request->persons;
        $fee->persons_after_deduction = $request->persons_after_deduction;
        $fee->fee_amount = $request->fee_amount;

        $fee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
