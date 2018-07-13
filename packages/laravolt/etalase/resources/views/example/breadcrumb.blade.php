@extends('etalase::layout')
@section('content-inner')

    @etalase('Breadcrumb')
    <div class="ui segment basic secondary">
        <div class="ui breadcrumb">
            <a class="section">Home</a>
            <div class="divider"> / </div>
            <a class="section">Settings</a>
            <div class="divider"> / </div>
            <div class="active section">Theme</div>
        </div>
    </div>
    @endetalase

    <div class="ui message info">
        <p>Letakkan tag breadcrumb di atas tepat di bawah <code>content__body</code> di base layout.</p>
    </div>

@endsection
