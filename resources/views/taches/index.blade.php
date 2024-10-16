<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des tâches</title>
</head>
<body>
<h2>La liste des tâches</h2>

@if(!empty($taches))
    <ul>
        @foreach($taches as $tache)
            <li>{{$tache->expiration->format("D M Y")}} {{$tache->categorie}} {{$tache->description}} accomplie :
                {{$tache->effectuee ? 'oui' : 'non'}}
            </li>
        @endforeach
    </ul>
@else
    <h3>aucune tâche</h3>
@endif
</body>
</html>
