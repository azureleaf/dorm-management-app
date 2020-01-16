<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    // Show all the payments
    public function showAll()
    {
        $data = [
            'payments' => DB::table('payments')
            ->get()
        ];
        return view('PaymentsController.payment', $data);
    }
}
