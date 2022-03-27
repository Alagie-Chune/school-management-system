<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;

use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// LOGOUT ROUTE
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


// USER MANAGEMENT ROUTES: NOTE: This is a way of grouping all related routes
Route::prefix('users')->group(function(){

    // View Users Route
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');

    // Add User Route
    Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');

    // Store/Create User Route
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

    // Edit User Route
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');

    // Update User Route
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

    // Delete User Route
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});


// USER PROFILE AND CHANGE PASSWORD ROUTES
Route::prefix('profile')->group(function(){

    // View Profile Route
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

    // Edit Profile Route
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

    // Store/Update Profile Route
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

    // Passsword View Route
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

    // Passsword Update Route
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});


// SETUP MANAGEMENT ROUTES
Route::prefix('setups')->group(function(){

    // STUDENT CLASS ROUTES 

    // View Student Class Route
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');

    // Add Student Class Route
    Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');

    // Store/Create Student Class Route
    Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');

    // Edit Student Class Route
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');

    // Update Student Class Route
    Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');

    // Delete Student Class Route
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');


    // ***********************************************************************************************************
    // STUDENT YEAR ROUTES 

    // View Student Year Route
    Route::get('student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');

    // Add Student Year Route
    Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');

    // Store/Create Student Year Route
    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');

    // Edit Student Year Route
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');

    // Update Student Year Route
    Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');

    // Delete Student Year Route
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');


    // ***********************************************************************************************************
    // STUDENT GROUP ROUTES 

    // View Student Group Route
    Route::get('student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');

    // Add Student Group Route
    Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');

    // Store/Create Student Group Route
    Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

    // Edit Student Group Route
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

    // Update Student Group Route
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');

    // Delete Student Group Route
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');


    // ***********************************************************************************************************
    // STUDENT SHIFT ROUTES 

    // View Student Group Route
    Route::get('student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');

    // Add Student Shift Route
    Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');

    // Store/Create Student Shift Route
    Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');

    // Edit Student Shift Route
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');

    // Update Student Group Route
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');

    // Delete Student Shift Route
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');


     // ***********************************************************************************************************
    // FEE CATEGORY ROUTES 

    // View Fee Category Route
    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');

    // Add Fee Category Route
    Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');

    // Store/Create Fee Category Route
    Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');

    // Edit Fee Category Route
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCategoryEdit'])->name('fee.category.edit');

    // Update Fee Category Route
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('update.fee.category');

    // Delete Fee Category Route
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');


    // ***********************************************************************************************************
    // FEE CATEGORY AMOUNT ROUTES 

    // View Fee Amount Route
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');

    // Add Fee Amount Route
    Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');

    // Store Fee Amount Route
    Route::post('fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');

    // Edit Fee Amount Route
    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');

    // Update Fee Amount Route
    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');

    // Details Fee Amount Route
    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');


    // ***********************************************************************************************************
    // EXAM TYPE ROUTES

    // View Exam Type Route
    Route::get('exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');

    // Add Exam Type Route
    Route::get('exam/type/add', [ExamTypeController::class, 'AddExamType'])->name('exam.type.add');

    // Store Exam Type Route
    Route::post('exam/type/store', [ExamTypeController::class, 'StoreExamType'])->name('store.exam.type');

    // Edit Exam Type Route
    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'EditExamType'])->name('exam.type.edit');

    // Update Exam Type Route
    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'UpdateExamType'])->name('update.exam.type');

    // Delete Exam Type Route
    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'DeleteFeeAmount'])->name('exam.dalete.delete');


    // ***********************************************************************************************************
    // SCHOOL SUBJECT ROUTES 

    // View School Subject Route
    Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSubject'])->name('school.subject.view');

    // Add School Subject Route
    Route::get('school/subject/add', [SchoolSubjectController::class, 'AddSubject'])->name('school.subject.add');

    // Store School Subject Route
    Route::post('school/subject/store', [SchoolSubjectController::class, 'StoreSubject'])->name('store.school.subject');

    // Edit School Subject Route
    Route::get('school/subject/edit{id}', [SchoolSubjectController::class, 'EditSubject'])->name('school.subject.edit');

    // Update School Subject Route
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'UpdateSubject'])->name('update.school.subject');

    // Delete School Subject Route
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'DeleteSubject'])->name('school.subject.delete');


    // ***********************************************************************************************************
    // ASSIGN SUBJECTS ROUTES

    // View Assign Subject Route
    Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');

    // Add Assign Subject Route
    Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');

    // Store Fee Amount Route
    Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');

    // Edit Fee Amount Route
    Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');

    // Update Fee Amount Route
    Route::post('assign/subject/edit/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');

    // Details Fee Amount Route
    Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');


    // ***********************************************************************************************************
    // DESIGNATION ROUTES 

    // View Designation Route
    Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');

    // Add Designation Route
    Route::get('designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');

    // Store/Create Designation Route
    Route::post('designation/store', [DesignationController::class, 'DesignationStore'])->name('store.designation');

    // Edit Designation Shift Route
    Route::get('designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');

    // Update Designation Route
    Route::post('designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('update.designation');

    // Delete Student Shift Route
    Route::get('designation/delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');

});


// STUDENT REGISTRATION ROUTES
Route::prefix('students')->group(function(){

    // View Student Registration Route
    Route::get('/reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');

    // Add Student Registration Route
    Route::get('/reg/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');

    // Store/Create Student Registration Route
    Route::post('/reg/store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');

    // Search Student Route
    Route::get('/year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');

    // Edit Student Registration Route
    Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');

    // Update Student Registration Route
    Route::post('/reg/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');

    // Promote Student Route
    Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');

    // Update Student Promotion Route
    Route::post('/reg/update/promotion/{student_id}', [StudentRegController::class, 'StudentUpdatePromotion'])->name('promotion.student.registration');

    // Student Details Route
    Route::get('/reg/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');


    // ***************************************************************************************************************
    // STUDENT ROLL GENERATE ROUTES

    // View Student Roll Generate Route
    Route::get('/roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');

    // Get Student Roll Generate Route
    Route::get('/roll/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');

    // Store/Generate Student Roll Route
    Route::post('/roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');


    // ***************************************************************************************************************
    // STUDENT REGISTRATION FEE ROUTES

    // View Student Registration Fee Route
    Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');

    // Get Student Registration Fee Route
    Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');

    // Student Registration Fee Payslip Route
    Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');

    //***************************************************************************************************************
    // STUDENT MONTHLY FEE ROUTES

    // View Student Monthly Fee Route
    Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');

    // Get Student Monthly Fee Route
    Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');

    // Student Monthly Fee Payslip Route
    Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');

    //***************************************************************************************************************
    // STUDENT EXAM FEE ROUTES

    // View Student Exam Fee Route
    Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');

    // Get Student Exam Fee Route
    Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');

    // Student Exam Fee Payslip Route
    Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePayslip'])->name('student.exam.fee.payslip');
}); 