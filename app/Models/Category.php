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
        $categorydetails = Category::select('id', 'parent_id', 'nama', 'url', 'deskripsi')->with(['subcategory'=>function($query){
            $query->select('id', 'parent_id', 'nama', 'url', 'deskripsi');
        }])->where('url', $url)->first()->toArray();
        // dd($categorydetails);
        $catid = array();
        $catid[] = $categorydetails['id'];

        if($categorydetails['parent_id']==0){
            //show main root in breadcumb
            $breadcum = '<li class="is-marked"><a href="'.url($categorydetails['url']).'">'.$categorydetails['nama'].'</a></li>';
        }else{
            $parentcategory = Category::select('nama', 'url')->where('id', $categorydetails['parent_id'])->first()->toArray();
            $breadcum = '<li class="has-separator"><a href="'.url($parentcategory['url']).'">'.$parentcategory['nama'].'</a>
            </li><li class="is-marked"><a href="'.url($parentcategory['url']).'">'.$parentcategory['nama'].'</a></li>';
        }

        foreach ($categorydetails['subcategory'] as $key => $subcat) {
            $catid[] = $subcat['id'];
        }
        $resp = array('catid'=>$catid, 'categorydetails'=>$categorydetails, 'breadcum'=>$breadcum);
        return $resp;
    }
    
    public static function getCategoryName($category_id)
    {
        $getCategoryName = Category::select('nama')->where('id', $category_id)->first();
        return $getCategoryName->nama;
    }
}
