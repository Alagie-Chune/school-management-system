<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    // View Student Year Method
    public function ViewYear() {
        $data['allData'] = StudentYear::latest()->get();
        return view('backend.setup.student_year.view_year', $data);
    }

    // Add Student Year Method
    public function StudentYearAdd() {
        return view('backend.setup.student_year.add_year');
    }

    // Store/Create Student Year Method
    public function StudentYearStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    // Edit Student Year Method
    public function StudentYearEdit($id) {
        $editData = StudentYear::find($id);
        return view('backend.setup.student_year.edit_year', compact('editData'));
    }

    // Update Student Year Method
    public function StudentYearUpdate(Request $request, $id) {

        $data = StudentYear::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    // Delete Student Year Method
    public function StudentYearDelete($id) {
        $user = StudentYear::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Year Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);
    }
}
