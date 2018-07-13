@extends('etalase::layout')
@section('content-inner')

    @etalase('Text Color')
        @foreach(['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black'] as $color)
            <div class="{{ $color }} text">{{ $color }}</div>
        @endforeach
    @endetalase

@endsection
