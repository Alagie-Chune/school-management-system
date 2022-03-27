<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    // View Student Class Method
    public function ViewStudent() {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    // Add Student Class Method
    public function StudentClassAdd() {
        return view('backend.setup.student_class.add_student');
    }

    // Store/Create Student Class Method
    public function StudentClassStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    // Edit Student Class Method
    public function StudentClassEdit($id) {
        $editData = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('editData'));
    }

    // Update Student Class Method
    public function StudentClassUpdate(Request $request, $id) {

        $data = StudentClass::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    // Delete Student Class Method
    public function StudentClassDelete($id) {
        $user = StudentClass::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Class Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('student.class.view')->with($notification);
    }
}
 