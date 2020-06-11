<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Billing::with("user")
            ->orderBy("paid_at", "desc")
            ->orderBy("id")
            ->get();
    }

    /**
     * Display list of arrear amounts by user
     *
     * @return \Illuminate\Http\Response
     */
    public function unpaid()
    {
        return  Billing::with("user")
            ->where("paid_at", NULL)
            ->orderBy("user_id")
            ->orderBy("closed_at")
            ->get();
    }

    /**
     * Display list of arrear amounts by user
     * with sum & count of the unpaid fees
     *
     * @return \Illuminate\Http\Response
     */
    public function ranking()
    {
        return  Billing::with("user")
            ->where("paid_at", NULL)
            ->groupBy("user_id")
            ->selectRaw('sum(amount) as sum, user_id')
            ->selectRaw('count(user_id) as months, user_id')
            ->orderBy("sum", "desc")
            ->get();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
