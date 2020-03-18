<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\colection;
use App\transaction;
use Carbon\Carbon;

class transactionController extends Controller
{
    public function insertTransaction(Request $request)
    {   
        $this->validate($request, [
            'id_card' => 'required|max:255',
            'id_colection' => 'required|integer',
            'date_from' => 'required|date',
            'status' => 'required|max:255'
        ]);
        $cek = colection::where('id', $request->id_colection)->count();

        if($cek){
            
        }


        $dt_now=Carbon::now();
        // $date_diff=$formatted_dt1->diffInDays($formatted_dt2);

        return response()->json($date_diff);
    }
}
