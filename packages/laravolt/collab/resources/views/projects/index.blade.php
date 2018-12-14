@extends(config('laravolt.collab.layout'))

@section('content')
    <h2 class="ui header">Projects</h2>

    {!! Suitable::source($projects)
    ->columns([
        new \Laravolt\Suitable\Columns\Numbering('No'),
        ['header' => 'Nama', 'raw' => function($item){
            return html()->a(route('collab::projects.show', $item['id']), $item['name']);
        }],
        ['header' => 'URL', 'field' => 'url_path'],
    ])
    ->render() !!}

@endsection
