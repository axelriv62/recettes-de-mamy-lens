{{-- resources/views/recettes/create.blade.php --}}
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

    <form action="{{ route('recettes.store') }}" method="POST" class="form-recette" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie" class="form-control">
                <option value="Entrée">Entrée</option>
                <option value="Plat">Plat</option>
                <option value="Dessert">Dessert</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nb_personnes">Nombre de personnes</label>
            <input type="number" name="nb_personnes" id="nb_personnes" value="{{ old('nb_personnes') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="temps_preparation">Temps de préparation</label>
            <input type="number" name="temps_preparation" id="temps_preparation" value="{{ old('temps_preparation') }}" min="0" class="form-control">
        </div>
        <div class="form-group">
            <label for="cout">Coût</label>
            <input type="number" name="cout" id="cout" value="{{ old('cout') }}" min="0" max="5" class="form-control">
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success" type="submit">Valider</button>
        </div>
    </form>
</x-app>
