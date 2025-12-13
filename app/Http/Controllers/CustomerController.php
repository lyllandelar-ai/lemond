<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return response()->json(['customers' => $customers]);
    }

    /**
     * Store a newly created customer.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
                'phone' => ['required', 'string', 'max:20'],
                'company' => ['nullable', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:500'],
                'city' => ['required', 'string', 'max:100'],
                'state' => ['required', 'string', 'max:100'],
                'zip_code' => ['required', 'string', 'max:20'],
                'notes' => ['nullable', 'string', 'max:1000'],
            ]);

            Log::info('Creating new customer', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'user_id' => Auth::id(),
            ]);

            // Create the customer
            $customer = Customer::create($validated);

            Log::info('Customer created successfully', [
                'customer_id' => $customer->id,
                'name' => $customer->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully!',
                'customer' => $customer,
            ], 201);

        } catch (ValidationException $e) {
            Log::warning('Customer validation failed', [
                'errors' => $e->errors(),
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error creating customer', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer.',
            ], 500);
        }
    }

    /**
     * Display the specified customer.
     */
    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            return response()->json(['customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found',
            ], 404);
        }
    }

    /**
     * Update the specified customer.
     */
    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:customers,email,' . $id],
                'phone' => ['required', 'string', 'max:20'],
                'company' => ['nullable', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:500'],
                'city' => ['required', 'string', 'max:100'],
                'state' => ['required', 'string', 'max:100'],
                'zip_code' => ['required', 'string', 'max:20'],
                'notes' => ['nullable', 'string', 'max:1000'],
            ]);

            $customer->update($validated);

            Log::info('Customer updated successfully', [
                'customer_id' => $customer->id,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully!',
                'customer' => $customer,
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating customer', [
                'error' => $e->getMessage(),
                'customer_id' => $id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the customer.',
            ], 500);
        }
    }

    /**
     * Remove the specified customer.
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            Log::info('Customer deleted successfully', [
                'customer_id' => $id,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully!',
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting customer', [
                'error' => $e->getMessage(),
                'customer_id' => $id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the customer.',
            ], 500);
        }
    }
}
