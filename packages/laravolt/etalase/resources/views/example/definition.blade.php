@extends('etalase::layout')
@section('content-inner')

    @etalase('Data Definition')
    <table class="ui table definition">
        <tr><td>Name</td><td>Jon Dodo</td></tr>
        <tr><td>Position</td><td>Web Developer</td></tr>
        <tr><td>Department</td><td>Software Development</td></tr>
        <tr><td>Join Date</td><td>1 February 2001</td></tr>
        <tr>
            <td>Skills</td>
            <td>
                <div class="ui label">Laravel</div>
                <div class="ui label">Grails</div>
                <div class="ui label">Node JS</div>
                <div class="ui label">Angular</div>
                <div class="ui label">Vue</div>
            </td>
        </tr>
    </table>
    @endetalase

    <div class="ui divider hidden section"></div>

    @etalase('Card Definition')
    <div class="ui card">
        <div class="image">
            <img src="{{ asset('img/avatar.jpg') }}">
        </div>
        <div class="extra p-0">
            <table class="ui table definition b-0">
                <tr><td>Name</td><td>Jon Dodo</td></tr>
                <tr><td>Position</td><td>Web Developer</td></tr>
                <tr><td>Department</td><td>Software Development</td></tr>
                <tr><td>Join Date</td><td>1 February 2001</td></tr>
            </table>
        </div>
    </div>
    @endetalase
@endsection
