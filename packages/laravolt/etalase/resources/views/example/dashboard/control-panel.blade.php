@extends('etalase::layout')
@section('content-inner')

    @etalase('Control Panel')

    <div class="ui cards four item">
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon users big red"></i>
                    <h3 class="ui header">User Management</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon circle thin big orange"></i>
                    <h3 class="ui header">Content Management System</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon square outline big yellow"></i>
                    <h3 class="ui header">App 1</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon flag big olive"></i>
                    <h3 class="ui header">App 2</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon options big green"></i>
                    <h3 class="ui header">Preferences</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon database big teal"></i>
                    <h3 class="ui header">Database</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon file big blue"></i>
                    <h3 class="ui header">File Manager</h3>
                </div>
            </div>
        </a>
        <a href="" class="card">
            <div class="content">
                <div class="ui segment basic center aligned very padded">
                    <i class="ui icon settings big purple"></i>
                    <h3 class="ui header">Settings</h3>
                </div>
            </div>
        </a>
    </div>


    @endetalase

@endsection
