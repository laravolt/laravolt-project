@extends('ui::layouts.app')

@section('content')

    <div class="ui secondary menu">
        <div class="item">
            <h2>Add Post</h2>
        </div>
        <div class="right menu">
            <div class="item">
                <a href="{{ route('post.index') }}" class="ui button basic small"><i class="icon angle left"></i>
                    Back to index
                </a>
            </div>
        </div>
    </div>

    {!! form()->post(route('post.store')) !!}
    {!! form()->text('title')->label('Title') !!}
    {!! form()->text('content')->label('Content') !!}
    {!! form()->text('author_id')->label('Author ID') !!}
    {!! form()->submit('Save') !!}
    {!! form()->link('Cancel', route('post.index')) !!}
    {!! form()->open() !!}

@stop
