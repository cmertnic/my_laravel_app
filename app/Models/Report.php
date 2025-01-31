<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'contact',
        'date',
        'time',
        'payment',
        'service_id',
        'statues_id', 
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statue() 
    {
        return $this->belongsTo(Statue::class, 'statues_id'); 
    }      

    public function service()
    {
        return $this->belongsTo(Service::class); 
    }
}
