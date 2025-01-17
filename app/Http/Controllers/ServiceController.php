<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'sub_category_id' => 'required|exists:sub_categories,sub_category_id',
                'provider_id' => 'required|exists:service_providers,provider_id',
                'description' => 'required|string',
                'service_fee' => 'required|numeric|min:0',
                'pictures' => 'nullable|array',
                'add_ons' => 'nullable|array',
                'sale_amount' => 'nullable|numeric|min:0',
                'sale_percentage' => 'nullable|numeric|min:0|max:100',
                'down_payment' => 'nullable|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $service = Service::create($validatedData);

        return response()->json($service, 201);
    }

    public function show($id)
    {
        $service = Service::with(['SubCategory', 'Provider'])->find($id);
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'title' => 'sometimes|string|max:255',
                'sub_category_id' => 'sometimes|exists:sub_categories,sub_category_id',
                'provider_id' => 'sometimes|exists:service_providers,provider_id',
                'description' => 'sometimes|string',
                'service_fee' => 'sometimes|numeric|min:0',
                'pictures' => 'nullable|array',
                'add_ons' => 'nullable|array',
                'sale_amount' => 'nullable|numeric|min:0',
                'sale_percentage' => 'nullable|numeric|min:0|max:100',
                'down_payment' => 'nullable|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $service->update($validatedData);

        return response()->json($service, 201);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        $service->delete();
        return response()->json(null, 201);
    }

    public function index(Request $request)
    {
        $query = Service::with(['SubCategory', 'Provider']);

        if ($request->has('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        if ($request->has('provider_id')) {
            $query->where('provider_id', $request->provider_id);
        }

        $services = $query->paginate(15);
        return response()->json($services);
    }

    public function search(Request $request)
    {
        $query = Service::query();

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        if ($request->has('min_price')) {
            $query->where('service_fee', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('service_fee', '<=', $request->max_price);
        }

        $services = $query->with(['SubCategory', 'Provider'])->paginate(15);
        return response()->json($services);
    }
}
