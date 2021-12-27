<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::all();
        return response()->json([
            "success" => true,
            "message" => "Books fetched.",
            "data" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'category' => 'required',
            'rate' => 'required',
            'publish_date' => 'required',
            'url' => 'required',
            'is_available' => 'required',
            'status' => 'required',
            ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $book = Book::create($input);
        return response()->json([
        "success" => true,
        "message" => "Book created successfully.",
        "data" => $book
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = book::find($id);
        if (is_null($book)) {
            return $this->sendError('Book does not exist.');
        }
        return response()->json([
            "success" => true,
            "message" => "Book fetched.",
            "data" => $book
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        // $book = Book::find($id);
        // return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'category' => 'required',
            'rate' => 'required',
            'publish_date' => 'required',
            'url' => 'required',
            'is_available' => 'required',
            'status' => 'required',
            ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
            $book->title = $input['title'];
            $book->author = $input['author'];
            $book->description = $input['description'];
            $book->rate = $input['rate'];
            $book->publish_date = $input['publish_date'];
            $book->url = $input['url'];
            $book->is_available = $input['is_available'];
            $book->status = $input['status'];
            $book = $book->save();
        return response()->json([
            "success" => true,
            "message" => "Book updated successfully.",
            "data" => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return response()->json([
            "success" => true,
            "message" => "Book deleted."
            ]);
    }
}
