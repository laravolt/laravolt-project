@extends('etalase::layout')
@section('content-inner')
    <form action="" class="ui form">
        <div class="field">
            <label for="">Destination</label>
            <select class="ui search">
            </select>
        </div>
    </form>
@endsection

@push('body')
<script>
    $(function () {
        $('.ui.search')
                .dropdown({
                    apiSettings: {
                        url: '{{ url('etalase/search') }}/{query}'
                    },
                    saveRemoteData: false
                });
    });
</script>
@endpush
