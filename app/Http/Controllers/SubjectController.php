<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function show($id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            return response()->json([
                'data' => $subject,
                'message' => 'Subject found successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Subject not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $subject = Subject::create($inputs);

        return response()->json([
            'data' => $subject,
            'message' => 'Subject created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            $subject->update($request->all());

            return response()->json([
                'data' => $subject,
                'message' => 'Subject updated successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Not found subject'
            ]);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        $subject->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subject deleted successfully'
        ]);
    }
}

