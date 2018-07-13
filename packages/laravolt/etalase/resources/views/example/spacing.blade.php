@extends('etalase::layout')
@section('content-inner')

    @etalase('Padding')
    <div class="ui segment p-0">
        No padding
    </div>
    <div class="ui segment p-x-0">
        No horizontal padding
    </div>
    <div class="ui segment p-y-0">
        No vertical padding
    </div>
    <div class="ui segment p-2">
        Double padding
    </div>
    @endetalase

    <div class="ui divider hidden section"></div>

    @etalase('Margin')
    <div class="ui segment m-0">
        No margin
    </div>
    <p>content here...</p>

    <div class="ui segment m-1">
        Margin all
    </div>
    <p>content here...</p>

    <div class="ui segment m-2">
        Double margin all
    </div>
    <p>content here...</p>
    @endetalase

    <div class="ui divider hidden section"></div>

    <h2 class="ui header">Available Class</h2>

    <div class="ui grid stackable two column">
        <div class="column">
            <h3 class="ui header">Padding</h3>
    <pre><code>
    .p-0
    .p-t-0
    .p-r-0
    .p-b-0
    .p-l-0
    .p-x-0
    .p-y-0
    .p-1
    .p-t-1
    .p-r-1
    .p-b-1
    .p-l-1
    .p-x-1
    .p-y-1
    .p-2
    .p-t-2
    .p-r-2
    .p-b-2
    .p-l-2
    .p-x-2
    .p-y-2

        </code></pre>
        </div>
        <div class="column">
            <h3 class="ui header">Margin</h3>
    <pre><code>
    .m-0
    .m-t-0
    .m-r-0
    .m-b-0
    .m-l-0
    .m-x-0
    .m-y-0
    .m-1
    .m-t-1
    .m-r-1
    .m-b-1
    .m-l-1
    .m-x-1
    .m-y-1
    .m-2
    .m-t-2
    .m-r-2
    .m-b-2
    .m-l-2
    .m-x-2
    .m-y-2

        </code></pre>
        </div>
    </div>
@endsection
