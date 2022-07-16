<?php

namespace App\Http\Controllers;

use App\Models\R24;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class R24Controller extends Controller
{
    //

    public function edit($id)
    {
        $title = 'Setting R24';
        $r24 = R24::find($id);
        return view('pages.r24.form', compact(['title', 'r24']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'curah_hujan' => 'required|numeric|between:0,999.999',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (!empty($request->id)) {
                DB::beginTransaction();
                try {
                    $r24 =  R24::find($request->id);
                    $r24->curah_hujan  = $request->curah_hujan;
                    $r24->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("r24.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }
}