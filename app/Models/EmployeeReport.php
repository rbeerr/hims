<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    use HasFactory;

    // Specify the table name (if it's not the pluralized version of the model name)
    protected $table = 'employee_report';

    // Fields that are mass assignable
    protected $fillable = ['employee_id', 'service_type', 'table_number', 'operation_timestamp'];

    // Disable Laravel's default timestamps (created_at and updated_at)
    public $timestamps = false;

    // Relationship with the User model
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    
}
