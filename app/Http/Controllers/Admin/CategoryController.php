<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function createCategory(){
        return view('admin.categorySetting.createCategory');
    }

    public function storeCategory(Request $request){

        $request->validate([
            'name' => 'required',
            'image' => 'required'
        ]);

        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/category'), $imageName);


            $category = new Category;
            $category->name = $request->name;
            $category->image = $imageName;
            $category->save();
        }

        return redirect('categories')->with('addedCategory' , 'you added a new category');

    }
    public function showCategories(){
        $categories = Category::get();
        return view('admin.categorySetting.showCategories' , compact('categories'));
    }

    public function deleteCategory($id){
        $deleteCategory = Category::destroy($id);
        return redirect('categories')->with('deleteCategory' , 'You deleted a category');
    }


    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.categorySetting.editCategory' , compact('category'));
    }

    public function updateCategory(Request $request , $id){

        $request->validate([
            'name' => 'required',
        ]);

        if(isset($request->image)){
            $imageName  = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('image/category'), $imageName);

            $category = Category::find($id);
            $category->image = $imageName;
            $category->save();
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect('categories')->with('updateCategory' , 'You updated a category');
    }

}
