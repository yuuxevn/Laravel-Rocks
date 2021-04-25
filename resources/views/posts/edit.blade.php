@extends('layouts.master', ['title' => 'Update Post'])
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Update Post <h5>{{ $post->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="/posts/{{ $post->slug }}/edit" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        @include('posts.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop