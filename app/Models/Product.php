<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Section;
use App\Models\penyedia;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'nama');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
