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
        return view('addBookView');
    }

    public function saveCategory(Request $request){
        $categoryName = $request->input('categoryName');
        $userId = Auth::id();
        $bookCategory = new BookCategory();
        $bookCategory->book_category_name = $categoryName;
        $bookCategory->AddByID = $userId;
        $bookCategory->save();

        $bookCategoryData = BookCategory::where('AddByID',$userId)->get();
        return response()->json([
            'bookCategoryData' => $bookCategoryData,
            'status' => 'true',
        ]);
    }
}
