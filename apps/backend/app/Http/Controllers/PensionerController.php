<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pensioner;
use Illuminate\Http\Request;

class PensionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all
        try {
            $pensioners = Pensioner::all();
            //select * from pensioners;
            $response = [
                'success' => true,
                'data' => $pensioners,
                'message' => 'Pensioners fetched successfully.'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching pensioners.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create new
        try {
            //validation
            $validatedData = $request->validate([
                'serial_number' => 'required|string|max:10|unique:pensioners',
                'control_number' => 'required|string|max:20|unique:pensioners',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'pension_account' => 'required|string|max:20',
                'rank' => 'required|string|max:50',
                'bank_name' => 'required|string|max:255',
                'amount_centavos' => 'required|numeric',
                'retirement_date' => 'required|date'
            ]);

            $pensionerData = [
                ...$validatedData,
                'amount_centavos' => $validatedData['amount_centavos'] * 100, // Convert to centavos
            ];

            $pensioner = Pensioner::create($pensionerData);
            //insert into pensioners (last_name, first) values ('Doe', 'John');
            $response = [
                'success' => true,
                'data' => $pensioner,
                'message' => 'Pensioner created successfully.'
            ];
            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while saving pensioner.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get by id
        try {
            $pensioner = Pensioner::FindOrFail($id);
            return response()->json($pensioner, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching pensioner.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update by id
        try {
            $pensioner = Pensioner::FindOrFail($id);

            //validation
            $validatedData = $request->validate([
                'serial_number' => 'required|string|max:10|unique:pensioners',
                'control_number' => 'required|string|max:20|unique:pensioners',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'pension_account' => 'required|string|max:20',
                'rank' => 'required|string|max:50',
                'bank_name' => 'required|string|max:255',
                'amount_centavos' => 'required|numeric',
                'retirement_date' => 'required|date'
            ]);

            $pensionerData = [
                ...$validatedData,
                'amount_centavos' => $validatedData['amount_centavos'] * 100, // Convert to centavos
            ];

            $pensioner->update($pensionerData);

            return response()->json($pensioner, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating pensioner.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete by id
        try {
            $pensioner = Pensioner::FindOrFail($id);
            $pensioner->delete();
            return response()->json([
                'message' => 'Pensioner deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting pensioner.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
