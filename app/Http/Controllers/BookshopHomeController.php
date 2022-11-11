<?php

namespace App\Http\Controllers;
use App\Author;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Book;
use App\PdfFile;
use App\Category;
use App\ReadState;
use Illuminate\Http\Request;

class BookshopHomeController extends Controller
{
    public function index()
    {
        # Home page Books
        $engineering_books = Book::with('category')->whereHas('category', function($query) {
            $query->where('slug', 'engineering'); })
            ->take(8)
            ->latestFirst()
            ->get();
        $literature_books = Book::with('category', 'author', 'image', 'pdf_file')
            ->whereHas('category', function ($query){
                $query->where('slug', 'literature'); })
            ->take(4)
            ->latestFirst()
            ->get();
        $discount_books = Book::with('category')
            ->where('discount_rate', '>', 0)
            ->orderBy('discount_rate', 'desc')
            ->take(6)
            ->get();
        return view('public.home', compact('engineering_books', 'discount_books', 'literature_books'));
    }
    public function allBooks()
    {
        # ComposerServiceProvider load here
        $books = Book::with('author', 'image', 'category', 'pdf_file')
                    ->orderBy('id', 'DESC')
                    ->search(request('term')) #...Search Query
                    ->paginate(16);
        return view('public.book-page', compact('books'));
    }
    public function discountBooks()
    {
        # ComposerServiceProvider load here
        $discountTitle = "All discount books";
        $books = Book::with('author', 'image', 'category', 'pdf_file')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)
            ->paginate(16);
        return view('public.book-page', compact('books', 'discountTitle'));
    }
    /*
     * Books filter by category
     */
    public function category(Category $category)
    {
        $categoryName = $category->name;
        $books = $category->books()
            ->with('category', 'author', 'image')
            ->orderBy('id','DESC')
            ->paginate(16);
        return view('public.book-page', compact('books', 'categoryName'));
    }
    /*
     * Books filter by author
     */
    public function author(Author $author)
    {
        $authorName = $author->name;
        $books = $author->books()
            ->with('category', 'author', 'image')
            ->orderBy('id', 'DESC')
            ->paginate(12);
        return view('public.book-page', compact('books', 'authorName'));
    }

    public function bookDetails($id)
    {
        // $book = Book::findOrFail($id);
        $book = Book::with('readstates')->findOrFail($id);
        $book_reviews = $book->reviews()->latest()->get();
        // $state = Book::with('readstates')->get();
        if ($book->pdf_id != 0){
            $pdf_file_url = PdfFile::findOrFail($book->pdf_id);
        }
        else{
            $pdf_file_url = PdfFile::findOrFail(1);
        }
        return view('public.book-details' , compact('book', 'book_reviews', 'pdf_file_url'));
    }

    public function readDirect(Request $request)
    {
        $temp = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->get();
        // var_dump($temp);
        if(count($temp) == 0){
            $readState = new ReadState;
            $readState->user_id = $request->user;
            $readState->book_id = $request->book;
            $readState->state = $request->state;
            $readState->save();
        }

        return response()->json(['success'=>'success']);
    }

    public function readDuration(Request $request)
    {
        $temp = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', $request->state)->get();
        // var_dump($temp);
        if(count($temp) == 0){
            $readState = new ReadState;
            $readState->user_id = $request->user;
            $readState->book_id = $request->book;
            $readState->state = $request->state;
            $readState->limit_time = $request->time;
            $readState->save();
        }

        return response()->json(['success'=>'success']);
    }
}
