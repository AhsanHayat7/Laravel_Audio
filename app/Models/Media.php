<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','audio_path', 'video_path', 'user_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
