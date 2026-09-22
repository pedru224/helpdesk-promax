<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department_id',
        'requester_name',
        'priority',
        'description',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
