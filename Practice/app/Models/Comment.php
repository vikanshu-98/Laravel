<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $visible = ['id','commentable_type','commentable_id'];
    public function commentable()
    {
        return $this->morphTo();
    }
}
