<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
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
