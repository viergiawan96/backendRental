<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\colection;
use App\transaction;

class rentalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $data = colection::all();
        return ResponseFormatter::success(compact('data'), 'Data Berhasil Diambil');   
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|integer',
            'category' => 'required',
            'quantity' => 'required|integer'
        ]);

        $datas = $request->all();
        $data = colection::create($datas);
        
        if(!$datas)
            return ResponseFormatter::error('Data Gagal Ditambah', 400);
        else
            return ResponseFormatter::success(compact('data'), 'Data Berhasil Ditambah');
    }

    public function update(Request $request)
    {
        $cek = colection::find($request->id);

        if(!$cek)
        return ResponseFormatter::error('No ID tidak ada', 400);

        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|integer',
            'category' => 'required',
            'quantity' => 'required|integer'
        ]);

        $items = colection::findOrFail($request->id)->update([
            'title' => $request->title,
            'rate' => $request->rate,
            'category' => $request->category,
            'quantity' => $request->quantity
        ]);
        
        $data = $request->all();

        if($items)
            return ResponseFormatter::success(compact('data'), 'Data BerHasil Diubah');
        else
            return ResponseFormatter::error('Data Gagal Diubah', 400);
    }

    public function delete($id)
    {
        $data = colection::find($id);
        
        if($data){
            $data->delete();
            return ResponseFormatter::success(null, 'Data Berhasil Dihapus');
        }
        else
            return ResponseFormatter::error('Data Tidak Ada', 400);
    }
    
}
