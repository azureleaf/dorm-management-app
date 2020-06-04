<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleHistory;
use Carbon\Carbon;

class RoleHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoleHistory::with("user")
            ->with("roleTitle")
            ->orderBy("start_at", "desc")
            ->orderBy("role_title_id")
            ->orderBy("reward_pct", "desc")
            ->get();
    }

    /**
     * Display a list of incumbent committee members
     * as of the date specified in the request.
     * 
     * @return \Illuminate\Http\Response
     */
    public function incumbents(Request $request)
    {
        $date = Carbon::parse($request->date);
        return RoleHistory::whereDate("start_at", "<=", $date)
            ->whereDate("end_at", ">=", $date)
            ->with("user")
            ->with("roleTitle")
            ->orderBy("start_at", "desc")
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
        $hx = new RoleHistory;
        $hx->user_id = $request->user_id;
        $hx->role_title_id = $request->role_title_id;
        $hx->start_at = $request->start_at;
        $hx->end_at = $request->end_at;
        $hx->fiscal_year = $request->fiscal_year;
        $hx->term = $request->term;
        $hx->reward_pct = $request->reward_pct;
        $hx->comment = $request->comment;
        $hx->save();
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
    public function update(Request $request, $hx_id)
    {
        $hx = RoleHistory::find($hx_id);
        $hx->role_title_id = $request->role_title_id;
        $hx->start_at = $request->start_at;
        $hx->end_at = $request->end_at;
        $hx->fiscal_year = $request->fiscal_year;
        $hx->term = $request->term;
        $hx->reward_pct = $request->reward_pct;
        $hx->comment = $request->comment;
        $hx->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($hx_id)
    {
        $hx = RoleHistory::find($hx_id);
        $hx->delete();
    }
}
