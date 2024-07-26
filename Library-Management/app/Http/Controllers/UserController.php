<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;


class UserController extends Controller
{
    public function borrowBooksView(){
        $userId = Auth::id();

        $booksData = DB::table('books')
            ->join('books_category as cat','cat.id','=','books.CategoryID')
            ->join('book_authors as ath','ath.id','=','books.AuthorID')
            ->select('books.id','books.book_name','cat.book_category_name',
                    'ath.author_name','books.BorrowedID')
            ->get();
        if(!($booksData->isEmpty())){
            foreach($booksData as $book){
                if($book->BorrowedID == $userId || $book->BorrowedID == 0){
                    $book->UsableBook = 'true';
                }else{
                    $book->UsableBook = 'false';
                }

                if($book->BorrowedID == $userId){
                    $book->bookBorrowed = 'true';
                }else{
                    $book->bookBorrowed = 'false';
                }
            }
        }
        return view('borrowBooksView',compact('booksData'));
    }

    public function borrowBook(Request $request){

        $userId = Auth::id();
        $action = $request->input('action');
        $bookID = $request->input('bookID');

        if($action == 'borrow'){
            Book::where('id',$bookID)
                ->update([
                    'BorrowedID'=>$userId,
                ]);
            return response()->json([
                'status'=>'true',
                'message' => 'Book Borrowed SuccessFully',
                'action' => 'Return',
            ]);
        }else{
            Book::where('id',$bookID)
            ->update([
                'BorrowedID'=>0,
            ]);

            return response()->json([
                'status'=>'true',
                'message' => 'Book Returned SuccessFully',
                'action'  => 'Borrow',
            ]);
        }
    }
}
