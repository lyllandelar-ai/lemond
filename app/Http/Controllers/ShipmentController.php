<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($shipments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'carrier' => 'required|string|max:255',
            'estimated_delivery' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $shipment = Shipment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Shipment created successfully!',
            'shipment' => $shipment,
            'tracking_number' => $shipment->tracking_number
        ]);
    }

    public function show($id)
    {
        $shipment = Shipment::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($shipment);
    }

    public function update(Request $request, $id)
    {
        $shipment = Shipment::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'customer_name' => 'sometimes|string|max:255',
            'origin' => 'sometimes|string|max:255',
            'destination' => 'sometimes|string|max:255',
            'carrier' => 'sometimes|string|max:255',
            'estimated_delivery' => 'sometimes|date',
            'status' => 'sometimes|in:pending,in-transit,delivered,delayed',
            'notes' => 'nullable|string',
        ]);

        $shipment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Shipment updated successfully!',
            'shipment' => $shipment
        ]);
    }

    public function destroy($id)
    {
        $shipment = Shipment::where('user_id', Auth::id())->findOrFail($id);
        $shipment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shipment deleted successfully!'
        ]);
    }
}
