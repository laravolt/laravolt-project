@extends('etalase::layout')
@section('content-inner')

    <div class="ui segment basic center aligned">
        <h2 class="ui header horizontal divider">Flash Message</h2>
    </div>

    <a name="basic"></a>
    @etalase('Dark', 'etalase::example.flash.dark')

@endsection

@push('body')
<script>
    $(function(){

        $(document).on('click', '.ui.button.flash--success', function(){
            Messenger({}).post({"message":"Success bro, good job!","type":"success"});
        });
        $(document).on('click', '.ui.button.flash--error', function(){
            Messenger({}).post({"message":"Opps, error bro!","type":"error"});
        });
        $(document).on('click', '.ui.button.flash--info', function(){
            Messenger({}).post({"message":"Woro-woro!","type":"info"});
        });

    });
</script>
@endpush
