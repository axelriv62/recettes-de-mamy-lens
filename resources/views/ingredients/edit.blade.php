{{-- resources/views/ingredients/edit.blade.php --}}
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

    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST" class="form-recette" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $ingredient->nom) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="nature">Nature</label>
            <textarea name="nature" id="nature" class="form-control">{{ old('nature', $ingredient->nature) }}</textarea>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success" type="submit">Valider</button>
        </div>
    </form>

    <form action="{{ route('ingredients.upload', $ingredient->id) }}" method="POST" class="form-recette" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="visuel">Visuel</label>
            <input type="file" name="visuel" id="visuel" class="form-control">
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success" type="submit">Télécharger</button>
        </div>
    </form>
</x-app>
