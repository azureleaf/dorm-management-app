<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingDetail;
use App\Billing;

class BillingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BillingDetail::with("billing", "billing.user", "personalAccountTitle")->orderBy("id")->get();
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
     * Store a newly created billing details: fee, rewards, penalties.
     * This controller updates both billing details table & billings table.
     *
     * @param  \Illuminate\Http\Request  $request
     *      Example of original JS Axios payload:
     *      {
     *          closedAt: "2020-06-04",
     *          year: 2020,
     *          month: 5,
     *          users: [
     *              {
     *                  userId: 20,
     *                  billingDets: [
     *                      { accountTitleId: 200, amount: 12345, comment: ""},
     *                      { accountTitleId: 105, amount: -2000, comment: ""},
     *                  ]
     *              },
     *              {
     *                  userId: 24,
     *                  billingDets: [
     *                      { accountTitleId: 200, amount: 12345, comment: ""},
     *                  ]
     *              },
     *          ]
     *      }
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Loop for all the users
        foreach ($request->users as $user) {

            $bill = Billing::create([
                "closed_at" => $request->closedAt, // YYYY-MM-DD
                "user_id" => $user["userId"],
                "amount" => 0, // will be updated later
                "year" => $request->year,
                "month" => $request->month,
            ]);
            $bill->save(); // This sets "id" to $bill

            // Sum up all the amount of billing details
            $billingSum = 0;

            foreach ($user["billingDets"] as $billingDet) {
                $det = BillingDetail::create([
                    "personal_account_title_id" => $billingDet["accountTitleId"],
                    "amount" => $billingDet["amount"],
                    "comment" => $billingDet["comment"],
                    "billing_id" => $bill->id,
                ]);
                $det->save();

                $billingSum += $billingDet["amount"];
            }

            $bill->amount = $billingSum;
            $bill->save();
        }
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
