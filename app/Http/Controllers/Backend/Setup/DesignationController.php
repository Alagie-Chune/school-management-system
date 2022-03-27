<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    // View Desigantion Method
    public function ViewDesignation() {
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    // Designation Add Method
    public function DesignationAdd() {
        return view('backend.setup.designation.add_designation');
    }

    // Store/Create Designation Method
    public function DesignationStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.view')->with($notification);
    }

    // Edit Designation Class Method
    public function DesignationEdit($id) {
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));
    }

    // Update Designation Method
    public function DesignationUpdate(Request $request, $id) {

        $data = Designation::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.view')->with($notification);
    }

     // Delete Designation Method
     public function DesignationDelete($id) {
        $user = Designation::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('designation.view')->with($notification);
    }
}
