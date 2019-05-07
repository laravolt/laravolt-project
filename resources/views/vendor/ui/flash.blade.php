@if (!empty($bags))
    <script>
        @foreach($bags as $bag)
        Messenger({
            extraClasses: 'messenger-fixed messenger-on-top animated',
            theme: 'dark'
        }).post({!! json_encode($bag) !!});
        @endforeach
    </script>
@endif
