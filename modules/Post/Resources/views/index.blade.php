@extends('ui::layouts.app')

@section('content')

    <div class="ui secondary menu">
        <div class="item">
            <h2>Post</h2>
        </div>
        <div class="right menu">
            <div class="item">
                <a href="{{ route('post.create') }}" class="ui button primary"><i class="icon plus"></i> Add</a>
            </div>
        </div>
    </div>

    {!! $table !!}
@stop

@push('script')
    <script>
      $(function () {
        $('[data-role=suitable-header-searchable]').on('keypress', 'input[type=text]', function (e) {
          if (e.which == 13) {
            $('[data-role=suitable-form-searchable]').submit();
          }
        });
        $('[data-role=suitable-header-searchable] .ui.dropdown').dropdown({
          onChange: function(val) {
            $('[data-role=suitable-form-searchable]').submit();
          }
        });
      });
    </script>
@endpush
