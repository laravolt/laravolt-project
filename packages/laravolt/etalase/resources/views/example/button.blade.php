@extends('etalase::layout')
@section('content-inner')

    @etalase('Button')
    <button class="ui button primary">Primary Button</button>
    <button class="ui button">Default Button</button>
    @endetalase

    <div class="ui message info">
        <p>Usahakan dalam satu halaman hanya ada satu
            <button class="ui button primary mini">Primary Button</button>
            .
        </p>
    </div>

    <div class="ui divider hidden section"></div>

    @etalase('Form Button')

    <form class="ui form">
        <div class="field">
            <label>First Name</label>
            <input type="text" name="first-name" placeholder="First Name">
        </div>
        <div class="field">
            <label>Last Name</label>
            <input type="text" name="last-name" placeholder="Last Name">
        </div>
        <button class="ui button primary">Simpan</button>
        <button class="ui button">Batal</button>
    </form>
    @endetalase

    <div class="ui divider hidden section"></div>

    @etalase('Form Button (Boxed)')

    <form class="ui form segment very padded">
        <div class="field">
            <label>First Name</label>
            <input type="text" name="first-name" placeholder="First Name">
        </div>
        <div class="field">
            <label>Last Name</label>
            <input type="text" name="last-name" placeholder="Last Name">
        </div>
        <button class="ui button primary">Simpan</button>
        <button class="ui button">Batal</button>
    </form>
    @endetalase

    <div class="ui message info">
        <p>Posisi tombol dalam sebuah form adalah di <strong>kiri bawah</strong>.</p>
    </div>

    <div class="ui divider hidden section"></div>

    <h3 class="ui header dividing">Referensi</h3>
    <div class="ui list">
        <a href="http://www.lukew.com/ff/entry.asp?571" class="item" target="_blank">http://www.lukew.com/ff/entry.asp?571
            <i class="icon external"></i></a>
    </div>
@endsection
