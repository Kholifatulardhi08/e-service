<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Section;
use App\Models\penyedia;
use App\Models\ProductAtribute;
use App\Models\Images;

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

    public function attribute()
    {
        return $this->hasMany(ProductAtribute::class);
    }

    public function image()
    {
        return $this->hasMany(Images::class);
    }
}
