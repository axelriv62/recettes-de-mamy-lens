<x-app>
    <h1>Liste des recettes de Mamy Lens</h1>
    <div class="form-filtrage">
        <form action="{{ route('recettes.index') }}" method="get" id="filtrageForm">
            <select name="cat" class="form-select" onchange="document.getElementById('filtrageForm').submit();">
                <option value="All" @if($cat == 'All') selected @endif>-- Catégories --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie }}" @selected($cat == $categorie)>{{ $categorie }}</option>
                @endforeach
            </select>
            <select name="nb_personnes" class="form-select" onchange="document.getElementById('filtrageForm').submit();">
                <option value="All" @if($nb_personnes == 'All') selected @endif>-- Nombre de personnes --</option>
                <option value="1-2" @selected($nb_personnes == '1-2')>1-2</option>
                <option value="3-4" @selected($nb_personnes == '3-4')>3-4</option>
                <option value="5+" @selected($nb_personnes == '5+')>5+</option>
            </select>
            <select name="cout" class="form-select" onchange="document.getElementById('filtrageForm').submit();">
                <option value="All" @if($cout == 'All') selected @endif>-- Coût --</option>
                <option value="1" @selected($cout == '1')>1</option>
                <option value="2" @selected($cout == '2')>2</option>
                <option value="3" @selected($cout == '3')>3</option>
                <option value="4" @selected($cout == '4')>4</option>
                <option value="5" @selected($cout == '5')>5</option>
            </select>
            <select name="temps_preparation" class="form-select" onchange="document.getElementById('filtrageForm').submit();">
                <option value="All" @if($temps_preparation == 'All') selected @endif>-- Temps de préparation --</option>
                <option value="0-30" @selected($temps_preparation == '0-30')>0-30 minutes</option>
                <option value="31-60" @selected($temps_preparation == '31-60')>31-60 minutes</option>
                <option value="60+" @selected($temps_preparation == '60+')>60+ minutes</option>
            </select>
        </form>
        <a href="{{ route('recettes.index', ['random' => true]) }}" class="btn btn-primary">Random</a>
        <a href="{{ route('recettes.index', ['tri_par_notes' => true]) }}" class="btn btn-primary">Trier par notes</a>
        <a href="{{ route('recettes.create') }}" class="btn btn-success btn-add">Ajouter une recette</a>
    </div>

    @if(!empty($recettes))
        <div class="container-recettes">
            <div class="grid">
                @foreach($recettes as $recette)
                    <div class="recette-details card">
                        <div class="card-body">
                            <x-recette :recette="$recette"/>
                        </div>
                        <div class="list-buttons">
                            <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-primary">Afficher</a>
                            @can('update', $recette)
                                <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-edit">Modifier</a>
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
                @endforeach
            </div>
        </div>
    @else
        <h3>Aucune recette</h3>
    @endif
</x-app>
