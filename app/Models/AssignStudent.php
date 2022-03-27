<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    // Creates relationship between "users" table (id field) and "assign_students" table for (student_id field)
    public function student() {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    // Creates relationship between "discount_students" table (id field) and "assign_students" table for (assign_student_id)
    public function discount() {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }

    // Creates relationship between "student_classes" table (id field) and "assign_students" table (class_id field)
    public function student_class() {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
 
    // Creates relationship between "student_years" table (id field) and "assign_students" table for (year_id field)
    public function student_year() {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    // Creates relationship between "student_groups" table (id field) and "assign_students" table for (year_id field)
    public function student_group() {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    // Creates relationship between "student_shifts" table (id field) and "assign_students" table for (year_id field)
    public function student_shift() {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }
}
