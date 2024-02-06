<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = ['user_id', 'text', 'mobile'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribiute()
    {
        return verta($this->created_at);
    }
}
