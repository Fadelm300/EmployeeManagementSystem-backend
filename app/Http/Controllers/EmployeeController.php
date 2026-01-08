<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Employees retrieved successfully',
            'data' => $employees
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreEmployeeRequest $request)
        {
            try {
                $employee = Employee::create($request->validated());

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Employee created successfully',
                    'data'    => $employee
                ], 201);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create employee: ' . $e->getMessage()
                ], 500);
            }
        }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Employee not found'
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Employee retrieved successfully',
            'data'    => $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(UpdateEmployeeRequest $request, string $id)
        {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Employee not found'
                ], 404);
            }

            try {
                $employee->update($request->validated());

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Employee updated successfully',
                    'data'    => $employee
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update employee: ' . $e->getMessage()
                ], 500);
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}
