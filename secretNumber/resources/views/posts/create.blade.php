@extends('layouts.master', ['title' => 'create'])
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    New Post
                </div>
                <div class="card-body">
                    <form action="/posts/store" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @include('posts.partials.form', ['submit' =>'Created'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop