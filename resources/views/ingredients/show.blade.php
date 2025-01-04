<x-app>
    <div class="text-center" style="margin-top: 2rem">
        @if($action == 'delete')
            <h2>Suppression d'une ingredient</h2>
        @else
            <h2>Affichage d'une ingredient</h2>
        @endif
    </div>
    <div class="recette-details card">
        <div class="card-body">
            <x-ingredient :ingredient="$ingredient"/>
        </div>
        <div class="text-center mt-4">
            @can('update', $ingredient)
                <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-primary">Modifier</a>
            @endcan
            @can('delete', $ingredient)
                <form action="{{ route('ingredients.delete', $ingredient->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            @endcan
        </div>
    </div>
</x-app>
