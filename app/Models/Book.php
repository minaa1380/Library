<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'author', 'publishers', 'category_id', 'barcode' ,
        'inventory', 'status', 'description', 'pic'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStatus()
    {
        if ($this->status == 0)
            return 'آماده امانت';
        return 'در امانت';
    }
}
