<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class GenericController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $table)
    {
        //
       
        if (!Schema::hasTable($table)) {
            abort(404);
        }
        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));

            // Check if the model class exists
            if (!class_exists($modelClass)) {
                abort(404);
            }

            // Retrieve the data using the model
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
        // Check if the table exists in the database
        if (!Schema::hasTable($table)) {
            abort(404);
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
    public function show(string $table, string $id)
    {
        // Check if the table exists in the database
        if (!Schema::hasTable($table)) {
            abort(404);
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));

            // Check if the model class exists
            if (!class_exists($modelClass)) {
                abort(404);
            }

            // Retrieve the record using the model and ID
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
        // Check if the table exists in the database
        if (!Schema::hasTable($table)) {
            abort(404);
        }

        try {
            // Get the model class name based on the table name
            $modelClass = 'App\\Models\\' . Str::studly(Str::singular($table));

            // Check if the model class exists
            if (!class_exists($modelClass)) {
                abort(404);
            }

            // Retrieve the record using the model and ID
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
    public function destroy(string $id)
    {
        //
    }
}