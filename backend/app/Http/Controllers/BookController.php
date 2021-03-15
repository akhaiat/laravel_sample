<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{

  public function index(Request $request)
  {
      #キーワード受け取り
      $keyword = $request->input('keyword');

      #クエリ生成
      $query = Book::query();

      #もしキーワードがあったら
      if(!empty($keyword))
      {
        $query->where('name','like','%'.$keyword.'%')->orWhere('author','like','%'.$keyword.'%');
      }

      #ページネーション
      $data = $query->orderBy('created_at','desc')->paginate(10);
      return view('book.index')->with('books',$data)
      ->with('keyword',$keyword);
  }

  public function edit($id)
  {
      // DBよりURIパラメータと同じIDを持つBookの情報を取得
      $book = Book::findOrFail($id);

      // 取得した値をビュー「book/edit」に渡す
      return view('book/edit', compact('book'));
  }

  public function update(Request $request, $id)
  {
      $book = Book::findOrFail($id);
      $book->name = $request->name;
      $book->price = $request->price;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->save();

      return redirect("/book");
  }

  public function destroy($id)
  {
      $book = Book::findOrFail($id);
      $book->delete();

      return redirect("/book");
  }

  public function create()
  {
      // 空の$bookを渡す
      $book = new Book();
      return view('book/create', compact('book'));
  }

  public function store(Request $request)
  {
      $book = new Book();
      $book->name = $request->name;
      $book->price = $request->price;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->save();

      return redirect("/book");
  }
}
