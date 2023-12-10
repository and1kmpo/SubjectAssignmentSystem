<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function show($id)
    {
        $e = Student::find($id);
        if (isset($e)) {
            return response()->json([
                'data' => $e,
                'message' => 'Student found successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Student not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Student::create($inputs);
        return response()->json(([
            'data' => $e,
            'message' => 'Student created successfully'
        ]));
    }

    public function update(Request $request, $id)
    {
        $e = Student::find($id);
        if (isset($e)) {
            $e->document = $request->document;
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->phone = $request->phone;
            $e->email = $request->email;
            $e->address = $request->address;
            $e->city = $request->city;
            $e->picture = $request->picture;
            $e->semester = $request->semester;
            $e->program_id = $request->program_id;
            if ($e->save()) {
                return response()->json([
                    'data' => $e,
                    'message' => 'Student updated successfully'
                ]);
            };
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Not found student'
            ]);
        };
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
