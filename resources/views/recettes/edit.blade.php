{{--
    messages d'erreurs dans la saisie du formulaire.
--}}
<x-app>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--
    formulaire de saisie d'une tâche
    la fonction 'route' utilise un nom de route.
    '@csrf' ajoute un champ caché qui permet de vérifier
    que le formulaire vient du serveur.
    '@method('PUT') précise à Laravel que la requête doit être traitée
    avec une commande PUT du protocole HTTP
--}}
    <form action="{{ route('recettes.update', $recette->id) }}" method="POST" class="form-recette">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $recette->nom) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $recette->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie" class="form-control">
                <option value="entree" {{ old('categorie', $recette->categorie) == 'entree' ? 'selected' : '' }}>Entrée</option>
                <option value="plat" {{ old('categorie', $recette->categorie) == 'plat' ? 'selected' : '' }}>Plat</option>
                <option value="dessert" {{ old('categorie', $recette->categorie) == 'dessert' ? 'selected' : '' }}>Dessert</option>
            </select>
        </div>
        <div class="form-group">
            <label for="visuel">Visuel</label>
            <input type="text" name="visuel" id="visuel" value="{{ old('visuel', $recette->visuel) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="nb_personnes">Nombre de personnes</label>
            <input type="number" name="nb_personnes" id="nb_personnes" value="{{ old('nb_personnes', $recette->nb_personnes) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="temps_preparation">Temps de préparation</label>
            <input type="number" name="temps_preparation" id="temps_preparation" value="{{ old('temps_preparation', $recette->temps_preparation) }}" min="0" class="form-control">
        </div>
        <div class="form-group">
            <label for="cout">Coût</label>
            <input type="number" name="cout" id="cout" value="{{ old('cout', $recette->cout) }}" min="0" max="5" class="form-control">
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success" type="submit">Valider</button>
        </div>
    </form>
</x-app>
