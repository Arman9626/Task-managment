<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_by',
        'assigned_to',
        'status',
        'description',
    ];

    function createdByUser()
    {
         return  $this->belongsTo(User::class, 'created_by');
    }

    function assignedToUser(){
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
