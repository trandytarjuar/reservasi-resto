<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Kapasitas;

class KapasitasController extends Controller
{
    public function index()
    {
        $kapasitas = Kapasitas::all();
        return response()->json($kapasitas);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jumlah_orang' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            Kapasitas::create($request->all());

            $response = [
                'success' => 'New Kapasitas Created',
            ];
            return response()->json($response, Response::HTTP_CREATED);

        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($id)
    {
        $kapasitas = Kapasitas::find($id);

        if (!$kapasitas) {
            $error = [
                'error' => 'Kapasitas not found'
            ];
            return response()->json($error, Response::HTTP_NOT_FOUND);
        }

        return response()->json($kapasitas);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jumlah_orang' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $kapasitas = Kapasitas::find($id);

            if (!$kapasitas) {
                $error = [
                    'error' => 'Kapasitas not found'
                ];
                return response()->json($error, Response::HTTP_NOT_FOUND);
            }

            $existingKapasitas = Kapasitas::where('jumlah_orang', $request->input('jumlah_orang'))
                ->where('id', '<>', $id)
                ->first();

            if ($existingKapasitas) {
                $error = [
                    'error' => 'Jumlah orang sudah ada'
                ];
                return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $kapasitas->update(['jumlah_orang' => $request->input('jumlah_orang')]);

            return response()->json($kapasitas, Response::HTTP_OK);

        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy($id)
    {
        try {
            $kapasitas = Kapasitas::find($id);

            if (!$kapasitas) {
                $error = [
                    'error' => 'Kapasitas not found'
                ];
                return response()->json($error, Response::HTTP_NOT_FOUND);
            }

            $kapasitas->delete();

            $response = [
                'success' => 'Kapasitas deleted successfully'
            ];
            return response()->json($response, Response::HTTP_NO_CONTENT);

        } catch (\Exception $e) {
            // Tangkap kesalahan Exception
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
