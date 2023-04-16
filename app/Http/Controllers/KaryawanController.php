<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:30',
            'noKTP' => 'required|max:20',
            'telp' => 'required|max:20',
            'kota_tinggal' => 'required|max:20',
            'kota_penempatan' => 'required|max:20',
        ]);

        if (Karyawan::where('noKTP', $request->input('noKTP'))->exists()) {
            return response()->json([
                'message' => 'Data KTP Sudah Pernah Diinputkan!',
            ], 400);
        } else {
            DB::beginTransaction();
            try {
                $store = Karyawan::create([
                    'departemen_id' => $request->input('departemen_id'),
                    'nama' => $request->input('nama'),
                    'noKTP' => $request->input('noKTP'),
                    'telp' => $request->input('telp'),
                    'kota_tinggal' => $request->input('kota_tinggal'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'tanggal_masuk' => $request->input('tanggal_masuk'),
                    'kota_penempatan' => $request->input('kota_penempatan'),

                ]);

                DB::commit();

                return response()->json([
                    'data' => $store,
                    'message' => 'Berhasil Disimpan',
                ], 200);
            } catch (\Exception $th) {
                DB::rollBack();
                return $th;
            }
        }
    }

    public function edit(Request $request)
    {
        try {
            $id_dept = $request->input('id');
            $departemen = Karyawan::where('id', $id_dept)->first();

            return response()->json([
                'data' => $departemen,
                'message' => 'Berhasil',
            ], 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('id_edit');
            $data = [
                'departemen_id' => $request->input('departemen_id'),
                'telp' => $request->input('telp_edit'),
                'kota_tinggal' => $request->input('kota_tinggal_edit'),
                'tanggal_lahir' => $request->input('tanggal_lahir_edit'),
                'kota_penempatan' => $request->input('kota_penempatan_edit'),
            ];

            Karyawan::where('id', $id)->update($data);

            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil Diedit',
            ], 200);
        } catch (\Exception $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->input('id');

            $dept = Karyawan::where('id', $id)->first();

            return response()->json([
                'data' => $id,
                'dept' => $dept,
                'message' => 'Berhasil Dihapus',
            ], 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('id');
            Karyawan::where('id', $id)->delete();

            DB::commit();
            return response()->json([
                'data' => $id,
                'message' => 'Berhasil Dihapus',
            ], 200);
        } catch (\Exception $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function detail($id)
    {
        $karyawan = Karyawan::join('departemens', 'karyawans.departemen_id', '=', 'departemens.id')
            ->where('karyawans.id', $id)
            ->get();
        return view('home', compact('karyawan'));
    }
}
