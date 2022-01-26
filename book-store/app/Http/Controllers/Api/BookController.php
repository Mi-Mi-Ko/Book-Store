<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;

class BookController extends Controller
{
    public $book;
    
    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }

    /**
     * @SWG\Get(
     *     path="/api/books",
     *     summary="本情報取得",
     *     description="本情報を取得します。",
     *     produces={"application/json"},
     *     tags={"Book"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request error",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized error"
     *     ),
     * )
     */
    public function index()
    {
        log::info('getAllBooks.........');
        $books = $this->book->getAllBooks();
        return response()->json([
            "success" => true,
            "message" => "Book are fetched.",
            "data" => $books
        ]);
    }

    public function edit($id)
    {
        log::info('getBookById.........');
        $book = $this->book->getBookById($id);
        return response()->json([
            "success" => true,
            "message" => "Book is fetched.",
            "data" => $book
        ]);
    }

    /**
     * @SWG\Post(
     *     path="/api/book/create",
     *     summary="本情報登録",
     *     description="本情報を登録します。",
     *     produces={"application/json"},
     *     tags={"Book"},
     *     @SWG\Parameter(
     *         in="body",
     *         name="Book",
     *         description="List of book object",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="title", type="string", description="タイトル"),
     *             @SWG\Property(property="author", type="string", description="筆者"),
     *             @SWG\Property(property="description", type="string", description="内容"),
     *             @SWG\Property(property="category_id", type="integer", description="カテゴリID"),
     *             @SWG\Property(property="rate", type="integer", description="率"),
     *             @SWG\Property(property="publish_date", type="string", format="date", description="開始日"),
     *             @SWG\Property(property="url", type="string", description="URL"),
     *             @SWG\Property(property="is_available", type="boolean", description="利用可能"),
     *             @SWG\Property(property="status", type="integer", description="ステータス"),
     *             @SWG\Property(property="user_id", type="integer", description="ユーザーID"),
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request error",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized error"
     *     ),
     * )
     */
    public function store(Request $request, $id = null)
    {   
        $input = $request->except(['_token','_method']);
        if(!is_null($id)) 
        {
            log::info('Book Update.........');
            $this->book->createOrUpdate($id, $input);
            return redirect()->route('book.edit', ['id' => $id]);
        }
        else
        {
            log::info('Book Create.........');
            $this->book->createOrUpdate($id = null, $input);
            return redirect()->route('book.list');
        }
    }
    /**
     * @SWG\Get(
     *     path="/api/book/list/{cat_id}",
     *     summary="本情報検索",
     *     description="本情報を検索します。",
     *     produces={"application/json"},
     *     tags={"Book"},
     *     @SWG\Parameter(
     *         name="category_id",
     *         description="カテゴリID",
     *         in="path",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request error",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized error"
     *     ),
     * )
     */
    public function search($id) {
        log::info('Book search by category id.........');
        $books = $this->book->searchByCategory($id);
        return response()->json([
            "success" => true,
            "message" => "Book is fetched by category.",
            "data" => $books
        ]);
    }

    public function delete($id) {
        $books = $this->book->deleteBook($id);
        return response()->json([
            "success" => true,
            "message" => "Book is deleted."
        ]);
    }
}