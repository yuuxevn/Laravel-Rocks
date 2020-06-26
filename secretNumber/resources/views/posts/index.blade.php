@extends('layouts.master', ['title' => 'Index'])
@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-4">
        <div>
            @isset($category)
            <h4>Category : {{ $category->name }}</h4>
            @else
            <h4>All Article</h4>
            @endisset
            <hr style="background: yellow;">
        </div>
        <div>
            @if(Auth::check())
            <a href="{{ route('posts.create') }}" class="btn btn-danger">Create!</a>
            @endif
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $p)
        <div class="col-md-4">
            <div class="card mb-4">
                @if($p->thumbnail)
                <img style="height: 270px; object-fit: cover; object-position: center;" src="{{ $p->takeImage() }}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{ $p->title }}</h5>
                    </div>
                    <div>
                        <p><i> {{ Str::limit( $p->body, 100 , '.') }} </i></p>
                    </div>
                    <a href="/posts/{{ $p->slug }}" class="btn btn-success">Read more</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on {{ $p->created_at->diffForHumans() }}
                    @can('update', $p)
                    <a href="/posts/{{ $p->slug }}/edit" class="btn btn-sm btn-warning">edit</a>
                    @endcan
                </div>
            </div>
        </div>
        @empty
        <div>
            <div class="alert alert-danger">
                There's is no post
            </div>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@stop