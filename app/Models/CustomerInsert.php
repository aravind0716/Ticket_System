<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInsert extends Model
{
protected $table = 'customer';
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name','email','password',
];
}
