<div class="ui accordion sidebar__accordion" data-role="sidebar-accordion">
    @foreach($items as $item)

        @php($validChildren = 0)
        @foreach($item->children() as $submenu)
            @if(auth()->user()->can($submenu->data('permission')))
                @php($validChildren++)
            @endif
        @endforeach

        @if($item->hasChildren())
            @if($validChildren > 0)
            <div class="title {{ Laravolt\Ui\Menu::setActiveParent($item->children(), $item->link->isActive) }}">
                <i class="left icon {{ $item->data('icon') }}"></i>
                <span>{{ $item->title }}</span>
                <i class="angle down icon"></i>
            </div>
            <div class="content {{ Laravolt\Ui\Menu::setActiveParent($item->children(), $item->link->isActive) }} ">
                @if($item->hasChildren())
                    <div class="ui list">
                        @foreach($item->children() as $child)
                            @if(auth()->user()->can($child->data('permission')))
                            <a href="{{ $child->url() }}" data-parent="{{ $child->parent()->title }}" class="item {{ ($child->link->isActive)?'active':'' }} ">{{ $child->title }}</a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            @endif
        @elseif(auth()->user()->can($item->data('permission')))
            <a class="title empty {{ Laravolt\Ui\Menu::setActiveParent($item->children(), $item->link->isActive) }}"
               href="{{ $item->url() }}"
               data-parent="{{ $item->parent()->title }}">
                <i class="left icon {{ $item->data('icon') }}"></i>
                <span>{{ $item->title }}</span>
            </a>
            <div class="content"></div>
        @endif

    @endforeach
</div>
