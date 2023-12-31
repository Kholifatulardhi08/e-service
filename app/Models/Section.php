<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Section extends Model
{
    use HasFactory;

    public static function sections()
    {
        $getSection = Section::with('category')->where('status', 1)->get()->toArray();
        return $getSection;
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'section_id')->where(['parent_id'=>0, 'status'=>1])->with('subcategory');
    }
}
