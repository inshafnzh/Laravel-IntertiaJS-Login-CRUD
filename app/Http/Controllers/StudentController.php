<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function view(Request $request): Response
    {
        $students = DB::table('students')->get();
        return Inertia::render('Dashboard', compact('students'));
    }

    public function showForm() {
        return Inertia::render('Student/Add');
    }

    public function storeStudent(Request $request) {
        $path = "";
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('students', 'public');  
        }

        DB::table('students')->insert([
            'name'=>$request->name, 
            'age'=>$request->age,
            'status'=>$request->status,
            'image'=>$path,
        ]);

        return redirect()->route('dashboard');
    }

    public function deleteStudent(Request $request) {
        DB::table('students')->where('id', $request->id)->delete();
        return redirect()->route('dashboard');
    }

    public function editStudent($id) {
        $student = DB::table('students')->find($id);
        return Inertia::render('Student/Edit', compact('student'));
    }

    public function updateStudent(Request $request) {
        DB::table('students')->where('id', $request->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard');
    }
    
}
