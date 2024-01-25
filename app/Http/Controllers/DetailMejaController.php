<?php

namespace App\Http\Controllers;

use App\Models\DetailMeja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class DetailMejaController extends Controller
{
    public function index()
    {
        $details = DetailMeja::with('meja', 'kapasitas')->get();
        return response()->json($details, Response::HTTP_OK);
    }

    public function show($id)
    {
        $detail = DetailMeja::find($id);

        if (!$detail) {
            $error = [
                'error' => 'Detail not found'
            ];
            return response()->json($error, Response::HTTP_NOT_FOUND);
        }

        return response()->json($detail, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_meja' => 'required|exists:mejas,id',
                'id_kapasitas' => 'required|exists:kapasitas,id',
                'status' => 'in:avail,reserve',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $detail = DetailMeja::create($request->all());

            $response = [
                'Success' => 'New Detail Created',
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage(),
            ];

            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_meja' => 'exists:mejas,id',
                'id_kapasitas' => 'exists:kapasitas,id',
                'status' => 'in:avail,reserve',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $detail = DetailMeja::find($id);

            if (!$detail) {
                $error = [
                    'error' => 'Detail not found'
                ];
                return response()->json($error, Response::HTTP_NOT_FOUND);
            }

            // Update data Detail
            $detail->update($request->all());

            return response()->json($detail, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy($id)
    {
        DetailMeja::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
