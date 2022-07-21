<?php

namespace App\Http\Controllers\Api;

use App\Models\Genangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function layer($layer)
    {

        if ($layer == 'genangan') {
            $genangan = Genangan::all();

            foreach ($genangan as $key => $value) {
                // return response()->json([
                //     'dataku' => $value->id
                // ]);

                $data = null;
                $data['type'] = "FeatureCollection";
                $data['features'] =
                    [
                        [
                            "type" => "Feature",
                            "id" => $value->id,
                            "geometry" =>
                            [
                                "type" => "Point",
                                "coordinates" =>
                                [$value->longitude, $value->latitude]
                            ],
                            "properties" =>
                            [
                                "nama_jalan" => $value->nama_jalan,
                                "alamat" =>  $value->alamat,
                                "latitude" =>  $value->latitude,
                                "longitude" =>  $value->longitude,
                                "cctv_id" =>  $value->cctv_id,
                                "host" =>  $value->host,
                                "stream_id" =>  $value->stream_id,
                                "underConstruction" => false
                            ],
                        ]
                    ];
                $response[] = $data;
            }
            // return response()->json($response);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        }
    }
}