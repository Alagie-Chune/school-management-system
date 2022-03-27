<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    // View Student Group Method
    public function ViewGroup() {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_group.view_group', $data);
    }

    // Add Student Year Method
    public function StudentGroupAdd() {
        return view('backend.setup.student_group.add_group');
    }

    // Store/Create Student Group Method
    public function StudentGroupStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    // Edit Student Group Method
    public function StudentGroupEdit($id) {
        $editData = StudentGroup::find($id);
        return view('backend.setup.student_group.edit_group', compact('editData'));
    }

    // Update Student Group Method
    public function StudentGroupUpdate(Request $request, $id) {

        $data = StudentGroup::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    // Delete Student Group Method
    public function StudentGroupDelete($id) {
        $user = StudentGroup::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Group Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('student.group.view')->with($notification);
    }
}
