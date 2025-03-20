<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    static public function getRecord()
    {
    	return self::select('categories.*','users.name as created_by_name')
    				->join('users', 'users.id','=','categories.created_by')
    				->where('categories.is_delete','=',0)
    				->orderBy('categories.id','desc')
    				->paginate(50);
    }


    static public function getRecordActive()
    {
        return self::select('categories.*')
                    ->join('users', 'users.id','=','categories.created_by')
                    ->where('categories.is_delete','=',0)
                    ->where('categories.status','=',0)
                    ->orderBy('categories.name','asc')
                    ->paginate(50);
    }

    static public function getRecordMenu()
    {
        return self::select('categories.*')
                    ->join('users', 'users.id','=','categories.created_by')
                    ->where('categories.is_delete','=',0)
                    ->where('categories.status','=',0)
                    ->get();
    }


    public function getSubcategory()
    {
        return $this->hasMany(SubCategoryModel::class,"category_id")->where('sub_category.status','=',0)
                    ->where('sub_category.is_delete','=',0);
    }

    static public function getSingle($id)
    {
    	return self::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug','=', $slug)
                ->where('categories.status','=',0)
                ->where('categories.is_delete','=',0)
                ->first();
    }
}
