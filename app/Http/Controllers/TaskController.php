<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import for custom validation rules (optional)

class TaskController extends Controller
{
    public function addtask(Request $request)
    {
        $rules = [ // Define custom validation rules (optional)
            "user_id" => "required|integer|exists:users,id", // Ensure user exists
            "name" => "required|string|max:255",
        ];

        $validator = Validator::make($request->all(), $rules); // Validate data

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Return validation errors
        }

        try {
            $task = new Task;
            $task->user_id = $request->user_id;
            $task->name = $request->name;
            $task->save(); // Save the task

            return response()->json([
                'message' => 'Task created successfully!',
                'data' => $task->with('user')->first(), // Load user data if needed
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating task: ' . $e->getMessage(),
            ], 500);
        }
    }
}
