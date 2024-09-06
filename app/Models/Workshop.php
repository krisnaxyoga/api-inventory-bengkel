<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'workshop_name',
        'owner_name',
        'address',
        'description',
        'primary_number',
        'secondary_number',
        'whatsapp_number',
        'email',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
