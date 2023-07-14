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

    public static function categorydetails($url)
    {
        $categorydetails = Category::select('id', 'nama', 'url')->with('subcategory')->where('url', $url)->first()->toArray();
        // dd($categorydetails);
        $catid = array();
        $catid[] = $categorydetails['id'];
        foreach ($categorydetails['subcategory'] as $key => $subcat) {
            $catid[] = $subcat['id'];
        }
        $resp = array('catid'=>$catid, 'categorydetails'=>$categorydetails);
        return $resp;
    }
}
