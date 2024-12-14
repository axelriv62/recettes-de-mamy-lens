<x-app>
    <h1>Liste des recettes de Mamy Lens</h1>
    <div class="form-filtrage">
        <form action="{{ route('recettes.index') }}" method="get" id="filtrageForm">
            <select name="cat" class="form-select" onchange="document.getElementById('filtrageForm').submit();">
                <option value="All" @if($cat == 'All') selected @endif>-- Toutes catégories --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie }}" @selected($cat == $categorie)>{{ $categorie }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('recettes.create') }}" class="btn btn-success btn-add">Ajouter une recette</a>
    </div>

    @if(!empty($recettes))
        <div class="container-recettes">
            <div class="grid">
                @foreach($recettes as $recette)
                    <div class="card">
                        <img src="{{ Storage::url($recette->visuel) }}" alt="{{ $recette->nom }}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title"><strong>{{ $recette->nom }}</strong></h3>
                            <p class="card-text"><strong>📖 Description:</strong> {{ $recette->description }}</p>
                            <p class="card-text"><strong>🍽️ Catégorie:</strong> {{ $recette->categorie }}</p>
                            <p class="card-text"><strong>👥 Nombre de personnes:</strong> {{ $recette->nb_personnes }}</p>
                            <p class="card-text"><strong>⏱️ Temps de préparation:</strong> {{ $recette->temps_preparation }} minutes</p>
                            <p class="card-text"><strong>💰 Coût:</strong> {{ $recette->cout }}</p>
                            <div class="list-buttons">
                            <form action="{{ route('recettes.show', $recette->id) }}" method="POST" style="text-align: center">
                                @csrf
                                <button type="submit" class="btn btn-primary">Afficher</button>
                            </form>
                                @can('update', $recette)
                                    <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-edit">Modifier</a>
                                @endcan
                                @can('delete', $recette)
                                    <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3>Aucune recette</h3>
    @endif
</x-app>
