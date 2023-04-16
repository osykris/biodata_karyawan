<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Depends;

class DepartemenController extends Controller
{
    public function store(Request $request)
	{
        $this->validate($request,[
            'nama_dept' => 'required|max:15'
         ]);

		if (Departemen::where('nama_dept', $request->input('nama_dept'))->exists()) {
            return response()->json([
                'message' => 'Data Sudah Pernah Diinputkan!',
            ], 400);
		} else {
			DB::beginTransaction();
			try {
				$store = Departemen::create([
					'nama_dept' => $request->input('nama_dept'),
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
			$departemen = Departemen::where('id', $id_dept)->first();

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
				'nama_dept' =>  $request->input('nama_dept_edit'),
			];

			Departemen::where('id', $id)->update($data);

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

			$dept = Departemen::where('id', $id)->first();

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
			Departemen::where('id', $id)->delete();

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
}
