<x-app>
    <div class="text-center" style="margin-top: 2rem">
        @if($action == 'delete')
            <h2>Suppression d'une recette</h2>
        @else
            <h2>Affichage d'une recette</h2>
        @endif
    </div>
    <div class="recette-details card">
        <div class="card-body">
            <x-recette :recette="$recette"/>
            <div class="text-center mt-4">
                @can('update', $recette)
                    <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-primary">Modifier</a>
                @endcan
                @can('delete', $recette)
                    <form action="{{ route('recettes.delete', $recette->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
    <div class="ingredients-section">
        <h3 style="text-align: center; margin-top: 2rem;">Ingrédients</h3>
        <div class="grid-ingredients">
            @foreach($recette->ingredients as $ingredient)
                <div class="card ingredient-card">
                    <div class="card-body">
                        <x-ingredient :ingredient="$ingredient"/>
                        <p class="card-text"><strong>📏 Quantité :</strong> {{ $ingredient->composition->quantite }}</p>
                        <p class="card-text"><strong>📝 Observation :</strong> {{ $ingredient->composition->observation }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app>
