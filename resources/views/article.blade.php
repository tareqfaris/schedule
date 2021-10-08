@extends('layouts.master')
@section('content')
<div class="p-3">
    <div class="m-3 text-center">
        <img src="{{asset('uploads/articles/'.$article->image)}}" alt="{{$article->title}}" width="50%" />
    </div>
    <div class="container">
        <h2>{{$article->title}}</h2>
        <span title="{{$article->created_at}}"><i class="fa fa-clock"></i> {{$article->created_at->diffForHumans()}}</span>
        <hr>
        <div>
            {!! $article->content !!}
        </div>
    </div>
</div>

@endsection
