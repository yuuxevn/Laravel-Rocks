@extends('layouts.master', ['title' => 'Index'])
@section('content')
<div class="container">
    <div class="d-flex-justify-content-between">
        <div>
            @isset($category)
            <h4>Category : {{ $category->name }}</h4>
            @endisset

            @isset($tag)
            <h4>Tag : {{ $tag->name }}</h4>
            @endisset

            @if(!isset($tag) && !isset($category))
            <h4>All Post</h4>
            @endif
            <hr style="background: yellow;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            @forelse ($posts as $p)
            <div class="card mb-4">
                @if($p->thumbnail)
                <a href="{{ route('posts.show', $p->slug) }}}">
                    <img style="height: 400px; object-fit: cover; object-position: center;" src="{{ $p->takeImage() }}"
                        alt="" class="card-img-top">
                </a>
                @endif
                <div class="card-body">
                    <div>
                        <a href="{{ route('categories.show', $p->category->slug ) }}" class="text-danger">
                            <small>{{ $p->category->name }} - </small>
                        </a>

                        @foreach($p->tags as $tag)
                        <a href="{{ route('tags.show', $tag->slug) }}" class="text-danger">
                            <small>{{ $tag->name }}</small>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('posts.show', $p->slug) }}" class="card-title">
                        <h5 class="text-dark">{{ $p->title }}</h5>
                    </a>
                    <div class="text-secondary my-3">
                        <p><i> {{ Str::limit( $p->body, 130 , '.') }} </i></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div>
                            <div class="media align-items-center">
                                {{-- {{ $post->author->gravatar() }} --}}
                                <img src="" class="rounded-circle mr-3" width="40">
                                <div class="media-body">
                                    <div>
                                        {{ $p->author->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-secondary">
                            <small>
                                Published on {{ $p->created_at->diffForHumans() }}
                            </small>
                        </div>
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
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@stop