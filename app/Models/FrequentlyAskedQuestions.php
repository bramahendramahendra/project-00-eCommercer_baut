<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrequentlyAskedQuestions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['question', 'answer', 'created_by', 'updated_by'];

}
