<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use App\Models\ColorModel;
use App\Models\BrandModel;

class ProductController extends Controller
{


    public function getProductSearch(Request $request)
    {
            $data['meta_title'] = 'Search';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            $data['getProduct'] = ProductModel::getProduct();
            $data['getColor'] = ColorModel::getRecordActive();
            $data['getBrand'] = BrandModel::getRecordActive();
            return view('product.list',$data);

    }


    public function getCategory($slug,$subslug = '')
    {

    	$getProductSingle = ProductModel::getSingleSlug($slug);
    	$getCategory = Category::getSingleSlug($slug);

    	$getSubCategory = SubCategoryModel::getSingleSlug($subslug);

    	$data['getColor'] = ColorModel::getRecordActive();
    	$data['getBrand'] = BrandModel::getRecordActive();


    	if (!empty($getProductSingle)) {

    		$data['meta_title'] = $getProductSingle->title;
    		$data['meta_description'] = $getProductSingle->short_description;

    		$data['getProduct'] = $getProductSingle;
    		$data['getRelatedProduct'] = ProductModel::getRelatedProduct($getProductSingle->id,$getProductSingle->sub_category_id);
	    	return view('product.detail',$data);
    	}

    	else if (!empty($getCategory)  &&  !empty($getSubCategory)) 
    	{
    		$data['meta_title'] = $getSubCategory->meta_title;
    		$data['meta_description'] = $getSubCategory->meta_description;
    		$data['meta_keywords'] = $getSubCategory->meta_keywords;

    		$data['getSubCategory'] = $getSubCategory;
    		$data['getCategory'] = $getCategory;

    		$data['getProduct'] = ProductModel::getProduct($getCategory->id,$getSubCategory->id);
    		$data['getSubCategoryFilter'] = SubCategoryModel::getRecordSubCategory($getCategory->id);

	    	return view('product.list',$data);
    	}

    	else if (!empty($getCategory)) {

    		$data['getSubCategoryFilter'] = SubCategoryModel::getRecordSubCategory($getCategory->id);

    		$data['meta_title'] = $getCategory->meta_title;
    		$data['meta_description'] = $getCategory->meta_description;
    		$data['meta_keywords'] = $getCategory->meta_keywords;

	    	$data['getCategory'] = $getCategory;


	    	$data['getProduct'] = ProductModel::getProduct($getCategory->id);
	    	return view('product.list',$data);
    	}
    	else {
    		abort(404);
    	}
    }


    public function getFilterProductAjax(Request $request)
	{
	    try {
	        $getProduct = ProductModel::getProduct();
	        
	        // Ensure getProduct is not null before rendering the view
	        if ($getProduct !== null) {
	            $view = view("product._list", [
	                "getProduct" => $getProduct,
	            ])->render();
	        } else {
	            // Handle the case where getProduct is null
	            throw new \Exception("No products found.");
	        }

	        return response()->json([
	            "status" => true,
	            "success" => $view,
	        ], 200);
	    } catch (\Exception $e) {
	        // Handle exceptions
	        return response()->json([
	            "status" => false,
	            "error" => $e->getMessage(),
	        ], 500);
	    }
	}

}
