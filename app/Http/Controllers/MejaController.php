<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;


class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();
        return response()->json($mejas);
    }
    public function show($id)
    {
        $meja = Meja::find($id);

        if (!$meja) {
            $error = [
                'error' => 'Data not found'
            ];
            return response()->json($error, Response::HTTP_NOT_FOUND);
        }

        return response()->json($meja);
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_meja' =>'required|unique:mejas'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            Meja::create($request->all());

            $response = [
                'success' => 'New Table Created',
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $meja = Meja::find($id);

            if (!$meja) {
                $error = [
                    'error' => 'Meja not found'
                ];
                return response()->json($error, Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'no_meja' => 'required|unique:mejas,no_meja,' . $id,
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $previousData = $meja->toArray();

            $meja->update($request->all());

            $updatedData = $meja->toArray();
            $dataChanged = $previousData != $updatedData;

            if ($dataChanged) {
                $response = [
                    'success' => 'Meja updated successfully',
                    'data' => $meja,
                ];
                return response()->json($response, Response::HTTP_OK);
            } else {
                $conflictError = [
                    'error' => 'No changes detected. The provided data is the same as the current data.'
                ];
                return response()->json($conflictError, Response::HTTP_CONFLICT);
            }
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function destroy($id)
    {
        try {
            $meja = Meja::find($id);

            if (!$meja) {
                $error = [
                    'error' => 'Meja not found'
                ];
                return response()->json($error, Response::HTTP_NOT_FOUND);
            }

            $meja->delete();

            $response = [
                'success' => 'Meja deleted successfully'
            ];
            return response()->json($response, Response::HTTP_NO_CONTENT);

        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
