<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
use HasFactory;

protected $fillable =[
    'department_id',
        'title',
        'requester_name',
        'priority',
        'description',
        'status'
];
        public function departament()
          {
            return $this->belongsTo(Departament::class);
          }
                     
}
