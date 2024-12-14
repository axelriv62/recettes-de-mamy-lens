<x-app>
    <div class="text-center" style="margin-top: 2rem">
        @if($action == 'delete')
            <h2>Suppression d'une recette</h2>
        @else
            <h2>Affichage d'une recette</h2>
        @endif
    </div>
    <div class="recette-details">
        <img src="{{ Storage::url($recette->visuel) }}" alt="{{ $recette->nom }}" style="height: 100px">
        <p><strong>Nom :</strong> {{ $recette->nom }}</p>
        <p><strong>Description :</strong> {{ $recette->description }}</p>
        <p><strong>Catégorie :</strong> {{ $recette->categorie }}</p>
        <p><strong>Nombre de personnes :</strong> {{ $recette->nb_personnes }}</p>
        <p><strong>Temps de préparation :</strong> {{ $recette->temps_preparation }}</p>
        <p><strong>Coût :</strong> {{ $recette->cout }}</p>
    </div>
    <div class="text-center mt-4">
        @can('update', $recette)
        <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-primary">Modifier</a>
        @endcan
        @can('delete', $recette)
        <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        @endcan
    </div>
</x-app>
