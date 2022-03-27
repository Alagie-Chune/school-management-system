<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    // View Fee Category Amount Method
    public function ViewFeeAmount() {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }


    // Add Fee Category Amount Method
    public function AddFeeAmount() {
        $data['fee_categories'] = FeeCategory::all(); // Fetch all data from fee_categories table
        $data['classes'] = StudentClass::all(); // Fetch all data from student_classes table
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }


    // Store Fee Category Amount Method
    public function StoreFeeAmount(Request $request) {
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            } // End For Loop
        } // End If Condition

        $notification = array(
            'message' => 'Fee Amount Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);

    } // End Method


    // Edit Fee Category Amount Method
    public function EditFeeAmount($fee_category_id) {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all(); // Fetch all data from fee_categories table
        $data['classes'] = StudentClass::all(); // Fetch all data from student_classes table
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    // Update Fee Category Amount Method
    public function UpdateFeeAmount(Request $request,$fee_category_id) {
        
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'No amount seleted!',
                'alert-type' => 'error'
            );
            return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);
        } else {
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            } 
        } 
            $notification = array(
            'message' => 'Amount Updated Successfully!',
            'alert-type' => 'success'
            );
            return redirect()->route('fee.amount.view')->with($notification);
    } // End Method


    // Details Student Class Method
    public function DetailsFeeAmount($fee_category_id) {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        return view('backend.setup.fee_amount.details_fee_amount',$data);
    }
}
