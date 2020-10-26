<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticketinsert extends Model
{
    protected $table = 'ticket';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_no', 'customer_id','emp_id','information','status',
    ];
}
