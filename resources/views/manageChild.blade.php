<ul >
    @foreach($children as $child)
        <li class="m-3">
            {{ $child->name }}
            @if(count($child->children))
                @include('manageChild',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
