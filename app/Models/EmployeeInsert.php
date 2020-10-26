<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeInsert extends Model
{
    protected $table = 'employee';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password'
    ];
}
