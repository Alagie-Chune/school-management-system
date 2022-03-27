<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\AssignSubject;

class AssignSubjectController extends Controller
{
    // View Assign Subject Method
    public function ViewAssignSubject() {
        // $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    // Add Assign Subject Method
    public function AddAssignSubject() {
        $data['subjects'] = SchoolSubject::all(); // Fetch all data from school_subjects  table
        $data['classes'] = StudentClass::all(); // Fetch all data from student_classes table
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }

    // Store Assign Subject Method
    public function StoreAssignSubject(Request $request) {
        $subjectCount = count($request->subject_id);
        if ($subjectCount != NULL) {
            for ($i = 0; $i < $subjectCount; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            } // End For Loop
        } // End If Condition

        $notification = array(
            'message' => 'Subject Assign Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.view')->with($notification);

    } // End Method


    // Edit Assign Subject Method
    public function EditAssignSubject($class_id) {
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        $data['subjects'] = SchoolSubject::all(); // Fetch all data from school_subjects  table
        $data['classes'] = StudentClass::all(); // Fetch all data from student_classes table
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    // Update Assign Subject Method
    public function UpdateAssignSubject(Request $request,$class_id) {
        
        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'No subject seleted!',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.edit',$class_id)->with($notification);
        } else {
            $countClass = count($request->subject_id);
            AssignSubject::where('class_id',$class_id)->delete();
            for ($i = 0; $i < $countClass; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            } 
        } 
            $notification = array(
            'message' => 'Updated Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('assign.subject.view')->with($notification);
    } // End Method


    // Details Assign Subject Method
    public function DetailsAssignSubject($class_id) {
        $data['detailsData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();

        return view('backend.setup.assign_subject.details_assign_subject',$data);
    }

}
