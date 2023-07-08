<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visits';
    protected $fillable = ['student_id', 'visit_datetime', 'explanation', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
