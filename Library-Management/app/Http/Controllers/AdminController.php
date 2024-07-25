<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function booksView(){

        return view('booksView');
    }

    public function addBookView(){
        $userId = Auth::id();

        $bookCategoryData = BookCategory::where('AddByID',$userId)->get();

        return view('addBookView',compact('bookCategoryData'));
    }

    public function saveCategory(Request $request){
        $categoryName = trim($request->input('categoryName'));
        $userId = Auth::id();

        $existCategory = BookCategory::where('AddByID',$userId)
                        ->where('book_category_name',$categoryName)
                        ->first();
        if(empty($existCategory)){
            $bookCategory = new BookCategory();
            $bookCategory->book_category_name = $categoryName;
            $bookCategory->AddByID = $userId;
            $bookCategory->save();
    
            $bookCategoryData = BookCategory::where('AddByID',$userId)->get();
            return response()->json([
                'bookCategoryData' => $bookCategoryData,
                'status' => 'true',
            ]);
        }else{
            return response()->json([
                'status' => 'false',
            ]);
        }
    }

    public function categoryList(){
        $userId = Auth::id();
        $bookCategoryData = BookCategory::where('AddByID',$userId)->get();

        return view('categoryList',compact('bookCategoryData'));
    }

    public function deleteCategory(Request $request){
        $id = $request->input('id');
        $category = BookCategory::where('id',$id)->first();
        if(!empty($category)){
            $category->delete();
            return redirect()->route('categoryList')->with('message','Category Deleted');
        }else{
            return redirect()->route('categoryList')->with('message','Category Not Found');
        }
        
    }

    public function getCategoryData(Request $request){
        $categoryID = $request->input('categoryId');
        $bookCategoryData = BookCategory::where('id',$categoryID)->first();
        return response()->json([
            'bookCategoryData'=>$bookCategoryData,
        ]);
    }

    public function editCategorySave(Request $request){
        $categoryID  = $request->input('categoryIDEdit');
        $categoryName = $request->input('bookCategoryEdit');

        $category = BookCategory::where('book_category_name',$categoryName)
                                    ->where('id','!=',$categoryID)
                                    ->first();
        if(empty($category)){
            BookCategory::where('id',$categoryID)->update([
                'book_category_name' => $categoryName,
            ]);
            return redirect()->route('categoryList')->with('message','Category Updated');
        }else{
            return redirect()->route('categoryList')->with('message','Category Name Alredy Taken.');
        }
    }
}
