<div class="example">
    <div class="example__title">
        <h2 class="ui header">{!! $title !!}</h2>
        <div class="ui buttons mini">
            <button class="ui button icon button--code"><i class="icon code"></i></button>
            <button class="ui button icon button--copy" data-position="bottom right" data-content="Copied to clipboard" data-inverted="" data-variation="mini inverted"><i class="icon copy"></i></button>
        </div>
    </div>

    <div class="example__code">
        <pre><code class="html">{{ $content }}</code></pre>
    </div>

    <div class="example__preview">
        {!! $content !!}
    </div>

</div>
