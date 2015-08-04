<?php
/**
 * Created by PhpStorm.
 * User: Babajide Owosakin
 * Date: 6/18/2015
 * Time: 10:41 AM
 */

namespace App\Http\Controllers;


use App\Category;

class CategoryController extends Controller {


    //get stories by category
    public function getStoriesByCategory($category_name){


    }

    public static function getCategories(){
        //gets all the categories from the database
        $categories = Category::all()->toArray();

        return $categories;
    }

} 