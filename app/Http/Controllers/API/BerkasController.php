<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Facade\FlareClient\Api;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'siswa_id' => 'required',
                'nilai_skhun' => 'required',
                'tahun' => 'required',
                'skhun_image' => 'required',
                'ijazah_image' => 'nullable',
                'nilai_ijazah' => 'nullable',
            ]);

            $berkas = Berkas::create([
                'siswa_id' => $request->siswa_id,
                'nilai_skhun' => $request->nilai_skhun,
                'tahun' => $request->tahun,
                'skhun_image' => $request->skhun_image,
                'nilai_ijazah' => $request->nilai_ijazah,
                'ijazah_image' => $request->ijazah_image,
            ]);

            $data = Berkas::where('id', '=', $berkas->id)->first();

            if ($data) {
                return ApiFormatter::createApi(200, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, "INTERNAL SERVER ERROR", $th);
        }
    }
}
