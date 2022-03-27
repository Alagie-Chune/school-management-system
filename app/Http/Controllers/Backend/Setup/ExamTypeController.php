<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    // Veiw ExamType Method
    public function ViewExamType() {
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    // Add ExamType Method
    public function AddExamType() {
        return view('backend.setup.exam_type.add_exam_type');
    }

    // Store/Create ExamType Method
    public function StoreExamType(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.view')->with($notification);
    }

    // Edit ExamType Method
    public function EditExamType($id) {
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('editData'));
    }

    // Update ExamType Method
    public function UpdateExamType(Request $request, $id) {

        $data = ExamType::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.view')->with($notification);
    }

    // Delete ExamType Method
    public function DeleteFeeAmount($id) {
        $user = ExamType::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Exam Type Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('exam.type.view')->with($notification);
    }
}
