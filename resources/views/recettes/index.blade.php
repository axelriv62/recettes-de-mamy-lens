<x-app>
    <h1>Liste des recettes de Mamy Lens</h1>
    <br>
    <h4>Filtrage par catégorie</h4>
    <form action="{{ route('recettes.index') }}" method="get">
        <select name="cat">
            <option value="All" @if($cat == 'All') selected @endif>-- Toutes catégories --</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie }}" @selected($cat == $categorie)>{{ $categorie }}</option>
            @endforeach
        </select>
        <input type="submit" value="OK">
    </form>

    @if(!empty($recettes))
        <ul>
            @foreach($recettes as $recette)
                <br>
                <hr>
                <br>
                <img src="{{ asset('storage/images/' . $recette->visuel) }}" alt="{{ $recette->nom }}" style="height: 100px">
                <li>
                    <h3>{{ $recette->nom }}</h3>
                    <p>Description: {{ $recette->description }}</p>
                    <p>Catégorie: {{ $recette->categorie }}</p>
                    <p>Nombre de personnes: {{ $recette->nb_personnes }}</p>
                    <p>Temps de préparation: {{ $recette->temps_preparation }} minutes</p>
                    <p>Coût: {{ $recette->cout }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <h3>Aucune recette</h3>
    @endif
</x-app>
