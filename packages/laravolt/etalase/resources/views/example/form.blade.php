@extends('etalase::layout')

@section('page.title', 'Form')

@section('content-inner')

    {{--<div class="ui segment basic center aligned">--}}
        {{--<h2 class="ui header horizontal divider">Form</h2>--}}
        {{--<div class="ui list">--}}
            {{--<a href="#basic" class="item">Basic</a>--}}
            {{--<a href="#advance" class="item">Advance</a>--}}
            {{--<a href="#error" class="item">Error Message</a>--}}
            {{--<a href="#datepicker" class="item">Datepicker</a>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="ui grid stackable two column">
        <div class="column">

            <div class="ui segment blue padded">
                @etalase('Quick Example', 'etalase::example.form.quick')
            </div>

            <div class="ui segment green padded">
                @etalase('Different Size', 'etalase::example.form.size')
            </div>
            <div class="ui segment orange padded">
                @etalase('Input Addon', 'etalase::example.form.input')
            </div>

        </div>
        <div class="column">
            <div class="ui segment purple padded">
                @etalase('Horizontal Form', 'etalase::example.form.horizontal')
            </div>
            <div class="ui segment red padded">
                @etalase('Different Width', 'etalase::example.form.width')
            </div>
            <div class="ui segment yellow padded">
                @etalase('General Elements', 'etalase::example.form.general')
            </div>
            <div class="ui segment yellow padded">
                @etalase('Datepicker', 'etalase::example.form.calendar')
            </div>
        </div>
    </div>


    {{--<a name="advance"></a>--}}
    {{--@etalase('Advance Form', 'etalase::example.form.advance')--}}

    {{--<a name="datepicker"></a>--}}
    {{--@etalase('Datepicker', 'etalase::example.form.calendar')--}}

    {{--<a name="error-message"></a>--}}
    {{--@etalase('Error State', 'etalase::example.form.error')--}}


@endsection
