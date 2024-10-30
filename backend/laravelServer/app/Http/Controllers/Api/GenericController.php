<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GenericController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $table)
    {
        $tableCheckResponse = $this->checkAvailability($table);
        if ($tableCheckResponse) {
            return $tableCheckResponse; // Return the JSON response if the table doesn't exist
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));
            $data = $modelClass::all();

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $table)
    {
        $tableCheckResponse = $this->checkAvailability($table);
        if ($tableCheckResponse) {
            return $tableCheckResponse; // Return the JSON response if the table doesn't exist
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));

            // Check if the model class exists
            if (!class_exists($modelClass)) {
                abort(404);
            }

            // Create a new instance of the model
            $record = new $modelClass();

            // Fill the record with the request data
            $record->fill($request->all());

            // Save the record to the database
            $record->save();

            return response()->json($record, 201);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $table, string $id)
    {
        $tableCheckResponse = $this->checkAvailability($table);
        if ($tableCheckResponse) {
            return $tableCheckResponse; // Return the JSON response if the table doesn't exist
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));
            $record = $modelClass::findOrFail($id);

            return response()->json($record);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $table, string $id)
    {
        $tableCheckResponse = $this->checkAvailability($table);
        if ($tableCheckResponse) {
            return $tableCheckResponse; // Return the JSON response if the table doesn't exist
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));
            $record = $modelClass::findOrFail($id);

            // Update the record with the request data
            $record->update($request->all());

            return response()->json($record);


        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $table, string $id)
    {
        $tableCheckResponse = $this->checkAvailability(table: $table);
        if ($tableCheckResponse) {
            return $tableCheckResponse; // Return the JSON response if the table doesn't exist
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));
            $record = $modelClass::findOrFail($id);
            $record->delete();
            return response()->json(['message' => 'Record deleted successfully']);

        } catch (ModelNotFoundException $e) {
            abort(404);
        }

    }

    public function checkAvailability($table)
    {
        $check = $this->checkHasTable($table);
        if ($check) {
            return $check; // Return the JSON response if the table doesn't exist
        }

        $check = $this->checkHasModel($table);
        if ($check) {
            return $check; // Return the JSON response if the table doesn't exist
        }
    }

    public function checkHasTable($table)
    {
        if (!Schema::hasTable($table)) {
            return response()->json("The table do not exists", 404);
        }
    }

    public function checkHasModel($table)
    {
        $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));
        if (!class_exists($modelClass)) {
            return response()->json("The table is not available", 404);
        }
    }
}