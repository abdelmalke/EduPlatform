<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::all();
        $data = [
            'status' => 200,
            'message' => 'courses retrieved successfully',
            'course' => $course
        ];
        return view('courses.index');
        // return response()->json($data, 200);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->image = $request->input('image');
        $course->author = $request->input('author');
        $course->save();

        return redirect()->route('courses.index');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->image = $request->input('image');
        $course->author = $request->input('author');
        $course->save();

        return redirect()->route('courses.index');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index');
    }
}
