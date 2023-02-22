<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function booted()
    {
        parent::boot();

       static::creating(function ($position) {
            $position->admin_created_id = Auth::user()->id;
            $position->admin_updated_id = Auth::user()->id;
        }); 

        static::updating(function ($position) {
            $position->admin_updated_id = Auth::user()->id;
        });
    }

}
