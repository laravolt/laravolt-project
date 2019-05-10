@extends('ui::layouts.app')

@section('content')

    <div class="ui secondary menu">
        <div class="item">
            <h2>Post Detail</h2>
        </div>
        <div class="right menu">
            <div class="item">
                <a href="{{ route('post.index') }}" class="ui button basic small"><i class="icon angle left"></i>
                    Back to index
                </a>
            </div>
        </div>
    </div>

    <table class="ui table definition">
        <tr><td>ID</td><td>{{ $post->getKey() }}</td></tr>
        <tr><td>Title</td><td>{{ $post->title }}</td></tr>
        <tr><td>Content</td><td>{{ $post->content }}</td></tr>
        <tr><td>Author ID</td><td>{{ $post->author_id }}</td></tr>
        <tr><td>Created At</td><td>{{ $post->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $post->updated_at }}</td></tr>
    </table>

@stop
