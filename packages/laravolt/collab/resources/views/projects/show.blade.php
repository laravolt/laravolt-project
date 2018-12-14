@extends(config('laravolt.collab.layout'))

@section('content')
    <h2 class="ui header">{{ $project['name'] }}</h2>

    <div class="ui grid four column stackable celled">
        <div class="column center aligned middle aligned">
            <div class="ui statistic red">
                <div class="value">{{ $project['count_tasks'] }}</div>
                <div class="label">Tasks</div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic orange">
                <div class="value">{{ $project['count_discussions'] }}</div>
                <div class="label">Discussions</div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic yellow">
                <div class="value">{{ $project['count_files'] }}</div>
                <div class="label">Files</div>
            </div>
        </div>
        <div class="column center aligned middle aligned">
            <div class="ui statistic teal">
                <div class="value">{{ $project['count_notes'] }}</div>
                <div class="label">Notes</div>
            </div>
        </div>
    </div>

    <div class="ui divider section"></div>

    <div class="ui list">
        @foreach($tasks as $task)
            <div class="item">
                {{ $task['name'] }}
            </div>
        @endforeach
    </div>

@endsection
