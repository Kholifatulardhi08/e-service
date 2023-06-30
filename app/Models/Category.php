<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Category extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'nama');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'nama');
    }
    
    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }
}
