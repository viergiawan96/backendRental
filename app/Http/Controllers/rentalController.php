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
        $colection = colection::all();
        return ResponseFormatter::success($colection, 'Data Berhasil Diambil');   
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|integer',
            'category' => 'required',
            'quantity' => 'required|integer'
        ]);

        $data = $request->all();
        $datas = colection::create($data);
        
        if(!$datas)
            return ResponseFormatter::error(null, 'Data Gagal Ditambah', 400);
        else
            return ResponseFormatter::success($datas, 'Data Berhasil Ditambah');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|integer',
            'category' => 'required',
            'quantity' => 'required|integer'
        ]);

        $items = colection::find($request->id)->update([
            'title' => $request->title,
            'rate' => $request->rate,
            'category' => $request->category,
            'quantity' => $request->quantity
        ]);
        
        if($items)
            return ResponseFormatter::success($request->all(), 'Data BerHasil Diubah');
        else
            return ResponseFormatter::error(null, 'Data Gagal Diubah', 400);
    }

    public function delete($id)
    {
        $data = colection::find($id)->first();
        $data->delete();

        return ResponseFormatter::success(null, 'Data Berhasil Dihapus');
    }
    
}
