<x-app>
    <div class="wrap">
        <div class="email-notification">
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center">
                    Un nouveau mail de vérification vient d'être envoyé !
                </div>
            @endif
            <div class="text-center marge-top marge-bot">
                <h3>Vérification de l'adresse mail</h3>
                <p>Vous devez valider votre adresse mail pour avoir accès à cette page.</p>
            </div>
            <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                @csrf
                <button type="submit" class="resent bouton-primary">Renvoyer une verification de l'email</button>
            </form>
        </div>
    </div>
</x-app>
