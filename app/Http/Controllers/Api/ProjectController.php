<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('attributes.attribute');

        if ($request->has('filters')) {
            $filters = $request->input('filters');

            foreach ($filters as $field => $value) {
                // Check if the filter is for an EAV attribute
                if (strpos($field, '.') !== false) {
                    [$attributeName, $operator] = explode('.', $field);
                    $operator = $this->getOperator($operator); // Get the operator or default to '='

                    $projects->whereHas('attributes.attribute', function ($query) use ($attributeName, $operator, $value) {
                        $query->where('name', $attributeName)
                            ->where('attribute_values.value', $operator, $value);
                    });
                } else {
                    // Regular attribute filtering
                    $operator = $this->getOperator(array_key_exists("$field.operator",$filters) ? $filters["$field.operator"] : null);
                    $projects->where($field, $operator, $value);
                }
            }
        }

        return $projects->get();
    }

    public function show(Project $project)
    {
        return $project->load('attributes.attribute');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'string',
            'attributes' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project = Project::create($request->only(['name', 'status']));

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attributeData) {
                AttributeValue::create([
                    'attribute_id' => $attributeData['attribute_id'],
                    'entity_id' => $project->id,
                    'entity_type' => Project::class, // Ensure this line is present
                    'value' => $attributeData['value'],
                ]);
            }
        }

        return response()->json($project->load('attributes.attribute'), 201);
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'status' => 'string',
            'attributes' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project->update($request->only(['name', 'status']));

        if ($request->has('attributes')) {
            $project->attributes()->delete(); // Clear old attributes
            foreach ($request->input('attributes') as $attributeData) {
                AttributeValue::create([
                    'attribute_id' => $attributeData['attribute_id'],
                    'entity_id' => $project->id,
                    'entity_type' => Project::class, // Ensure this line is present
                    'value' => $attributeData['value'],
                ]);
            }
        }

        return response()->json($project->load('attributes.attribute'), 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

    private function getOperator($operator)
    {
        $validOperators = ['=', '>', '<', 'LIKE'];
        return in_array($operator, $validOperators) ? $operator : '=';
    }
}