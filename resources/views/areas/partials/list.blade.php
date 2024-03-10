<ul>
    @foreach($areas as $area)
    <li>
        {{ $area->nombre }}
        - <a href="{{ route('areas.edit', $area->id) }}">Editar</a>
        - <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de querer eliminar esta área?')">Eliminar</button>
        </form>

        @if(!$area->children->isEmpty())
            @include('areas.partials.list', ['areas' => $area->children])
        @endif
    </li>
    @endforeach
</ul>
