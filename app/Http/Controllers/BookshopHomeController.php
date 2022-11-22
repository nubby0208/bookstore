<?php

namespace App\Http\Controllers;
use App\Author;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Book;
use App\PdfFile;
use App\Category;
use App\ReadState;
use Illuminate\Http\Request;
use Sburina\Whmcs\Facades\Whmcs;

class BookshopHomeController extends Controller
{
    private $gid = 2;
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
        $result = \Whmcs::GetProducts([
        ]);
        $pid = 0;
        foreach ($result['products']['product'] as $Item)
        {
            if($Item['name'] == 'New eBook')
                $pid = $Item['pid'];
        }

        $result = \Whmcs::AddOrder([
            'clientid' => $request->user,
            'paymentmethod' => 'paypal',
            'pid' => array($pid),
        ]);

        $result = \Whmcs::AddInvoicePayment([
            'invoiceid' => $result['invoiceid'],
            'transid' => $this->random_str(),
            'gateway' => 'paypal',
            'date' => '2023-01-01 12:33:12',
        ]);

        if($result["result"] != "success")
            return response()->json(['success'=>'fail']);

        $temp = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->get();
        // var_dump($temp);
        if(count($temp) == 0){
            $readState = new ReadState;
            $readState->user_id = $request->user;
            $readState->book_id = $request->book;
            $readState->state = $request->state;
            $readState->save();
        }
        else{
            ReadState::where('user_id', $request->user)->where('book_id', $request->book)->update(array('state'=>$request->state));
        }

        return response()->json(['success'=>'success']);
    }

    public function readDuration(Request $request)
    {
        $result = \Whmcs::GetProducts([
        ]);
        $group = array();
        foreach ($result['products']['product'] as $Item)
        {
            if($Item['gid'] == $this->gid)
                array_push($group, $Item);
        }

        $result = \Whmcs::AddOrder([
            'clientid' => $request->user,
            'paymentmethod' => 'paypal',
            'pid' => array($group[0]['pid']),
        ]);

        $result = \Whmcs::AddInvoicePayment([
            'invoiceid' => $result['invoiceid'],
            'transid' => $this->random_str(),
            'gateway' => 'paypal',
            'date' => '2023-01-01 12:33:12',
        ]);

        if($result["result"] != "success")
            return response()->json(['success'=>'fail']);
        
        $temp = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->get();
        // var_dump($temp);
        if(count($temp) == 0){
            $readState = new ReadState;
            $readState->user_id = $request->user;
            $readState->book_id = $request->book;
            $readState->state = $request->state;
            $readState->limit_time = $request->time;
            $readState->save();
        }
        else{
            ReadState::where('user_id', $request->user)->where('book_id', $request->book)->update(array('state'=>$request->state, 'limit_time'=>$request->time));
        }

        return response()->json(['success'=>'success']);
    }

    public function readRemain(Request $request)
    {

        $temp = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', 2)->get();
        $temp2 = ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', 3)->get();

        if(count($temp) != 0){
            ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', 2)->update(array('state'=>$request->state, 'remain_min'=>$request->remain_min, 'remain_sec'=>$request->remain_sec));
        }
        else if(count($temp2) != 0){
            ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', 3)->update(array('state'=>$request->state, 'remain_min'=>$request->remain_min, 'remain_sec'=>$request->remain_sec));
            if($request->remain_min == 0){
                ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', $request->state)->update(array('state'=>0, 'limit_time'=>0, 'remain_min'=>0, 'remain_sec'=>0));
            }
        }

        // ReadState::where('user_id', $request->user)->where('book_id', $request->book)->where('state', 2)->where('limit_time', $request->limit_time)->update(array('state'=>$request->state, 'remain_min'=>$request->remain_min, 'remain_sec'=>$request->remain_sec));
        return response()->json(['success'=>'success']);
    }

    /**
     * Generate a random string, using a cryptographically secure 
     * pseudorandom number generator (random_int)
     *
     * This function uses type hints now (PHP 7+ only), but it was originally
     * written for PHP 5 as well.
     * 
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     * 
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    private function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
