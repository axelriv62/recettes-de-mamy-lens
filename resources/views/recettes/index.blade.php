<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des recettes de Mamy Lens</title>
</head>
<body>
<h1>Liste des recettes de Mamy Lens</h1>

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
</body>
</html>
