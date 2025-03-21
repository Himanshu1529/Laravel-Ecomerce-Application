<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'sub_category';


    static public function getRecord()
    {
    	return self::select('sub_category.*','users.name as created_by_name','categories.name as category_name')
    				->join('categories', 'categories.id','=','sub_category.category_id')
    				->join('users', 'users.id','=','sub_category.created_by')
    				->where('sub_category.is_delete','=',0)
    				->orderBy('sub_category.id','desc')
    				->paginate(50);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug','=', $slug)
                ->where('sub_category.status','=',0)
                ->where('sub_category.is_delete','=',0)
                ->first();
    }

    static public function getRecordSubCategory($category_id)
    {
        return self::select('sub_category.*')
                    ->join('users', 'users.id','=','sub_category.created_by')
                    ->where('sub_category.is_delete','=',0)
                    ->where('sub_category.status','=',0)
                    ->where('sub_category.category_id','=',$category_id)
                    ->orderBy('sub_category.name','asc')
                    ->get();
    }

    static public function getSingle($id)
    {
    	return self::find($id);
    }

    public function TotalProduct()
    {
        return $this->hasMany(ProductModel::class,'sub_category_id')

                    ->where('product.is_delete','=',0)
                    ->where('product.status','=',0)
                    ->count();
    }
}
