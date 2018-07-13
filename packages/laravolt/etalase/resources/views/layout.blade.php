@extends('ui::layouts.app')

@section('content')
    @yield('content-inner')
@endsection

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/highlightjs/github.css') }}"/>
<style>
    .example {
        position: relative;
    }

    .example .example__title {
        margin-bottom: 2rem;
    }

    .example .example__title .ui.header {

    }

    .example .example__title .buttons {
        position: absolute;
        top: 0;
        right: 0;
    }

    .example .example__code {
        display: none;
        max-height: 400px;
        overflow: auto;
        margin-bottom: 2rem;
    }

    .example .example__code pre {
        margin: 0;
    }
</style>
@endpush

@push('body')
<script type="text/javascript" src="{{ asset('lib/highlightjs/highlight.pack.js') }}"></script>
<script src="{{ asset('lib/clipboard/clipboard.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.example pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
        $('.example').on('click', '.button--code', function (e) {
            $(e.delegateTarget).find('.example__code').toggle();
        });

        $('.example .button--copy').popup({
            on: 'manual'
        });

        clipboard = new Clipboard('.example .button--copy', {
            text: function (trigger) {
                return $(trigger).closest('.example').find('.example__preview').html();
            }
        });

        clipboard.on('success', function (e) {
            $(e.trigger).popup('show');
            setTimeout(function(){
                $(e.trigger).popup('hide');
            }, 2000);
        });

        $('.ui.calendar').each(function (idx, elm) {
            elm = $(elm);
            var format = elm.data('format');

            if (!format) {
                format = 'YYYY/MM/DD';
            }

            elm.calendar({
                type: 'date',
                formatter: {
                    date: function (date, settings) {
                        if (!date) {
                            return '';
                        }
                        var DD = ("0" + date.getDate()).slice(-2);
                        var MM = ("0" + (date.getMonth() + 1)).slice(-2);
                        var MMMM = settings.text.months[date.getMonth()];
                        var YY = date.getFullYear().toString().substr(2, 2);
                        var YYYY = date.getFullYear();

                        return format.replace('DD', DD).replace('MMMM', MMMM).replace('MM', MM).replace('YYYY', YYYY).replace('YY', YY);
                    }
                }
            });
        });

        Messenger.options = {
            extraClasses: 'messenger-fixed messenger-on-top animated',
            theme: 'dark'
        };

    });
</script>
@endpush
