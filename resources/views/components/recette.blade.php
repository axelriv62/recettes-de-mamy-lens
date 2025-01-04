<img src="{{ Storage::url('images/' . $recette->visuel) }}" alt="{{ $recette->nom }}" class="card-img-top">
<div class="card-body">
    @if($recette->note == 1)
        <h2 style="text-align: center">★☆☆☆☆</h2>
    @elseif($recette->note == 2)
        <h2 style="text-align: center">★★☆☆☆</h2>
    @elseif($recette->note == 3)
        <h2 style="text-align: center">★★★☆☆</h2>
    @elseif($recette->note == 4)
        <h2 style="text-align: center">★★★★☆</h2>
    @elseif($recette->note == 5)
        <h2 style="text-align: center">★★★★★</h2>
    @endif
    <br>
    <h3 class="card-title"><strong>{{ $recette->nom }}</strong></h3>
    <p class="card-text"><strong>📖 Description:</strong> {{ $recette->description }}</p>
    <p class="card-text"><strong>🍽️ Catégorie:</strong> {{ $recette->categorie }}</p>
    <p class="card-text"><strong>👥 Nombre de personnes:</strong> {{ $recette->nb_personnes }}</p>
    <p class="card-text"><strong>⏱️ Temps de préparation:</strong> {{ $recette->temps_preparation }} minutes</p>
    <p class="card-text"><strong>💰 Coût:</strong> {{ $recette->cout }}</p>
</div>
