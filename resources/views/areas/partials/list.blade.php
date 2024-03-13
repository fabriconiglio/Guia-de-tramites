<ul>
    @foreach($areas as $area)
    <li>
        {{ $area->nombre }}
        <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-sm btn-info">Editar</a>
        <form action="{{ route('areas.destroy', $area->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de querer eliminar esta área?');" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
        </form>

        @if($area->children)
            @include('areas.partials.list', ['areas' => $area->children])
        @endif
    </li>
    @endforeach
</ul>
