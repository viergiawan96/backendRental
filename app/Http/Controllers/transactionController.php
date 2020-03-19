<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\colection;
use App\transaction;
use Carbon\Carbon;

class transactionController extends Controller
{
    public function index()
    {
        $data = transaction::all();
        return ResponseFormatter::success(compact('data'), 'Data Berhasil Diambil');
    }

    public function insertTransaction(Request $request)
    {   
        $this->validate($request, [
            'id_card' => 'required|max:255',
            'id_colection' => 'required|integer'
        ]);
        
        $cek = colection::where('id', $request->id_colection)
                        ->where('quantity', '!=', 0)
                        ->count();

        if($cek){
            $price = colection::where('id', $request->id_colection)->first();

            $items = $request->all();
            $items['price'] = $price->rate;
            $items['status'] = 'OPEN';
            $data = transaction::create($items);

            if(!$data)
                return ResponseFormatter::error(null, 'Data Gagal Ditambah', 400);
            else
                $upd =colection::where('id', $request->id_colection)->decrement('quantity');
                return ResponseFormatter::success(compact('data'), 'Data Berhasil Ditambah');
        }
        else
            return responseValidasi::error('Cek Kembali Quantity atau cek id colection', 400);
    }

    public function checkAmount(Request $request)
    {
        $data = transaction::where('id_card', $request->id_card)
                            ->where('status', 'OPEN')
                            ->count();

        if($data){
            $datas = transaction::where('id_card', $request->id_card)
                                ->where('status', 'OPEN')->get();
            $total = 0;
            foreach($datas as $data)
            {
                $date = Carbon::parse($data->created_at)->diffInDays();
                if($date)
                    $jumlah = $date * $data->price;
                else 
                    $jumlah = 1 * $data->price;

                $total += $jumlah;
            }
            return ResponseFormatter::success(compact('total'), 'Data Berhasil Diambil');
        }
        else
            return responseValidasi::error('Cek Kembali ID Card', 400);
    }
    
    public function payTransaction(Request $request)
    {
        $data = transaction::where('id_card', $request->id_card)
                            ->where('status', 'OPEN')
                            ->count();

        if($data){

            $data = transaction::where('id_card', $request->id_card)
                                ->where('status', 'OPEN')
                                ->update(['status' => 'CLOSE']);

            return responseValidasi::success('Transaksi Berhasil');              
        }
        else
            return responseValidasi::error('Cek Kembali ID Card', 400);
    }
}
