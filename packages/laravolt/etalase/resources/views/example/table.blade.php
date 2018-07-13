@extends('etalase::layout')
@section('content-inner')

    <div class="ui segment basic center aligned">
        <h2 class="ui header horizontal divider">Table</h2>
        <div class="ui list">
            <a href="#basic" class="item">Basic</a>
            <a href="#dropdown" class="item">Dropdown Action</a>
            <a href="#single-line" class="item">Single Line</a>
            <a href="#datatable" class="item">Datatable</a>
        </div>
    </div>

    <a name="basic"></a>
    @etalase('Basic Table', 'etalase::example.table.basic')
    <div class="ui message warning">
        Gunakan inline action jika tombol aksinya tidak terlalu banyak (maksimal 3).
        Jika pilihan aksi lebih dari 3, gunakan dropdown seperti contoh di bawah ini.
    </div>

    <div class="ui divider hidden section"></div>

    <a name="dropdown"></a>
    @etalase('Dropdown Action', 'etalase::example.table.dropdown')

    <div class="ui divider hidden section"></div>

    <a name="single-line"></a>
    @etalase('Single Line', 'etalase::example.table.single')
    <div class="ui message warning">
        <p>Jika konten yang ditampilkan sangat panjang, gunakan jenis tabel single line agar tampilan lebih nyaman dilihat.</p>
        <p>Jangan lupa untuk <strong>mengatur width</strong> masing-masing kolom.</p>
    </div>

    <div class="ui divider hidden section"></div>
    
    <a name="datatable"></a>
    @etalase('Datatable', 'etalase::example.table.datatable')

@endsection
