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

        if(!$colection)
            return ResponseFormatter::error(null, 'data tidak ada!!', 404);
        else
            return ResponseFormatter::success($colection, 'Data Berhasil Diambil');
            
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'rate' => 'required|integer',
            'category' => 'required',
            'quantity' => 'required|integer'
        ]);

        if($validator->fails())
            return response()->json($validator->errors());

        $data = $request->all();
        $coll = collection::create($data);

        return ResponseFormatter::success($coll, 'Data Berhasil Ditambah');
    }

    public function update(Request $request)
    {
        
    }
    
}
