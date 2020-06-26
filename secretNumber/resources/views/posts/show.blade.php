@extends('layouts.master', ['title' => 'Post'])
@section('content')
<div class="contaier">
    <h1>{{ $post->title }}</h1>
    <hr>
    <div class="text-secondary">
        <a href="/categories/{{ $post->category->slug }}"> <small
                class="btn btn-dark">{{ $post->category->name }}</small> </a>
        &middot;
        @foreach($post->tags as $tag)
        <a href="#">{{ $tag->name }}</a>
        @endforeach
    </div>
    <small> <i class="fa fa-user">&nbsp;</i>{{ $post->author->name }}<br>
        <i class="fa fa-calendar"></i>&nbsp;Published on {{ $post->created_at }} &nbsp; <i
            class="fa fa-instagram-square"></i> </small>
    <hr>
    <p>{{ $post->body }}</p>
    <div>
        @can('delete', $post)
        <button type="button" class="btn btn-link btn-sm text-danger p-0" data-toggle="modal"
            data-target="#exampleModal">
            delete
        </button>
        <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah anda ingin menghapus?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <div>{{  $post->title }}</div>
                            <div class="text-secondary">
                                <small>Published on {{ $post->created_at->format('d F, Y') }}</small>
                            </div>
                            <form action="/posts/{{ $post->slug }}/delete" method="post">
                                @csrf
                                @method('delete')
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-danger mr-2">Yes</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
    @stop