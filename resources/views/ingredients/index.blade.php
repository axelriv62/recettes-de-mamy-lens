<x-app>
    <h1>Liste des ingrédients</h1>
    @if(!empty($ingredients))
        <div class="container-recettes">
            <div class="grid">
                @foreach($ingredients as $ingredient)
                    <div class="card">
                        <div class="card-body">
                            <x-ingredient :ingredient="$ingredient"/>
                        </div>
                        <div class="list-buttons">
                            @can('update', $ingredient)
                                <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-edit">Modifier</a>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3>Aucun ingrédient</h3>
    @endif
</x-app>
