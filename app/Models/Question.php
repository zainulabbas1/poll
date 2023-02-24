<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'question',
        'start_time',
        'end_time',
    ];
    public $timestamps = false;
    public function options()
    {
        return $this->hasMany(Option::class, 'question_id');
    }
}
