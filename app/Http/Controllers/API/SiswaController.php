<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Orangtua;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsiswa()
    {
        $data = Siswa::where('status_bayar', '=', 'sudah bayar')->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function siswabyid($id)
    {
        try {
            $siswa = Siswa::where('id', '=', $id)->first();
            $siswa->orangtua;
            $siswa->berkas;
            if ($siswa) {
                return ApiFormatter::createApi(200, 'Success', $siswa);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'Success', $th);
        }
    }

    public function jurusantkr()
    {
        try {
            $siswa = Siswa::where('jurusan', '=', 'SMK: Teknik Kendaraan Ringan')->where('status_bayar', '=', 'sudah bayar')->get()->count();
            if ($siswa) {
                return ApiFormatter::createApi(200, 'Success', $siswa);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'Success', $th);
        }
    }
    public function jurusantkj()
    {
        try {
            $siswa = Siswa::where('jurusan', '=', 'SMK: Teknik Komputer Jaringan')->where('status_bayar', '=', 'sudah bayar')->get()->count();
            if ($siswa) {
                return ApiFormatter::createApi(200, 'Success', $siswa);
            } else {
                return ApiFormatter::createApi(400, 'Failed', $siswa);
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'Internal Server Error', $th);
        }
    }
    public function getDataByTahun($tahun){
        try{
            if($tahun !== "semua"){
                $siswa = Siswa::where('tahun_ajaran', '=', $tahun)->where('status_bayar', '=', 'sudah bayar')->get();
                if ($siswa) {
                    return ApiFormatter::createApi(200, 'Success', $siswa);
                } else {
                    return ApiFormatter::createApi(400, 'Failed', $siswa);
                }
            } else {
                $siswa = Siswa::where('status_bayar', '=', 'sudah bayar')->get();
                if ($siswa) {
                    return ApiFormatter::createApi(200, 'Success', $siswa);
                } else {
                    return ApiFormatter::createApi(400, 'Failed', $siswa);
                }
                
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'Internal Server Error', $th);
        }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tgl_lahir' => 'required',
                'tempat_lahir' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'email' => 'required',
                'sekolah_asal' => 'required',
                'status_bayar' => 'required',
                'pass_foto' => 'required',
                'telp' => 'required',
                'jurusan' => 'required',
                'tahun_ajaran' => 'required'
            ]);

            $siswa = Siswa::create([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'sekolah_asal' => $request->sekolah_asal,
                'status_bayar' => $request->status_bayar,
                'pass_foto' => $request->pass_foto,
                'telp' => $request->telp,
                'jurusan' => $request->jurusan,
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);


            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-cwdsyXuTDyJumHA_VgjZXPip';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 385000,
                ),
                'customer_details' => array(
                    'first_name' => $siswa->nama,
                    'last_name' => '',
                    'email' => $siswa->email,
                    'phone' => $siswa->telp,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $list = [
                'id_siswa' => $siswa->id,
                'token' => $snapToken
            ];

            if ($snapToken) {
                return ApiFormatter::createApi(200, 'Success', $list);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'INTERNAL SERVER ERROR', $th);
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
        try {
            $request->validate([
                'status_bayar' => 'required',
            ]);

            $siswa = Siswa::find($id);

            if ($siswa) {
                $siswa->status_bayar = $request->status_bayar;
                $siswa->update();

                $data = Siswa::where('id', '=', $siswa->id)->get();

                if ($data) {
                    return ApiFormatter::createApi(200, 'Success', $siswa->id);
                } else {
                    return ApiFormatter::createApi(400, 'Failed');
                }
            } else {
                return ApiFormatter::createApi(404, 'Not Found');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(500, 'Internal Server Error', $th);
        }
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
