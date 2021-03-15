@extends('book/layout')
@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">Books</h3>
  </div>
</div>

<!--↓↓ 検索フォーム ↓↓-->
<div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
<form class="form-inline" action="{{url('/book')}}">
  <div class="form-group">
  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="名前を入力してください">
  </div>
  <input type="submit" value="検索" class="btn btn-info">
</form>
</div>
<!--↑↑ 検索フォーム ↑↑-->
<div class="col-sm-8" style="text-align:right;">
  <div class="paginate">
  {{ $books->appends(Request::only('keyword'))->links() }}
  </div>
</div>

<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">書籍名</th>
        <th class="text-center">価格</th>
        <th class="text-center">著者</th>
        <th class="text-center">概要</th>
        <th class="text-center">削除</th>
      </tr>
      @foreach($books as $book)
      <tr>
        <td>
          <a href="/book/{{ $book->id }}/edit">{{ $book->id }}</a>
        </td>
        <td>{{ $book->name }}</td>
        <td>{{ $book->price }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->desc }}</td>
        <td>
          <form action="/book/{{ $book->id }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <div><a href="/book/create" class="btn btn-default">新規作成</a></div>
  </div>
</div>
@endsection
