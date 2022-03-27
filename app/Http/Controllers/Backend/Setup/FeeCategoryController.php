<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    // View Fee Category Method
    public function ViewFeeCat() {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat', $data);
    }

    // Add Fee Category Method
    public function FeeCatAdd() {
        return view('backend.setup.fee_category.add_fee_cat');
    }

    // Store/Create Fee Category Method
    public function FeeCatStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    // Edit Fee Category Method
    public function FeeCategoryEdit($id) {
        $editData = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));
    }

    // Update Fee Category Method
    public function FeeCategoryUpdate(Request $request, $id) {

        $data = FeeCategory::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    // Delete Student Class Method
    public function FeeCategoryDelete($id) {
        $user = FeeCategory::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Fee Category Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }
}
