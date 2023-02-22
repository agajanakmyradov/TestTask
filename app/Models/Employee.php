<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'photo',
        'preview_photo',
        'position_id',
        'salary',
        'head_id',
        'employment_date',
        'admin_created_id',
        'admin_updated_id'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function head()
    {
        return $this->belongsTo(Employee::class, 'head_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'head_id');
    }

    public function headsCount()
    {
        $count = 0;
        $employee = $this;
        while($employee->head) {
            $count++;
            $employee = $employee->head;
        }
        return $count;
    }

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->admin_created_id = Auth::user()->id;
            $employee->admin_updated_id = Auth::user()->id;
        });

        static::updating(function ($employee) {
            $employee->admin_updated_id = Auth::user()->id;
        });

        static::deleting(function($employee){
            $head_id = $employee->head_id;

            if($employee->head_id === null && $employee->subordinates->count()) {
               $head_id = $employee->subordinates[0]->id;
            }

            $employee->subordinates->each(function($subordinate) use ($head_id){
               if ($subordinate->id == $head_id) {
                    $subordinate->update(['head_id' => null]);
               } else {
                    $subordinate->update(['head_id' => $head_id]);
               }
            });
        });
    }
}
