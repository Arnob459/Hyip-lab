<ul >
    @foreach($children as $child)
        <li class="ms-3">
            {{ $child->name }}
            @if(count($child->children))
                @include('manageChild',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
