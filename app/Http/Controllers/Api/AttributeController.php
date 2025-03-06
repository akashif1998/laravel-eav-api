<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }

    public function show(Attribute $attribute)
    {
        return $attribute;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|in:text,date,number,select',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attribute = Attribute::create($request->all());
        return response()->json($attribute, 201);
    }

    public function update(Request $request, Attribute $attribute)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'type' => 'in:text,date,number,select',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attribute->update($request->all());
        return response()->json($attribute, 200);
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(null, 204);
    }
}