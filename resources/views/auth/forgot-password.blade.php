<x-guest>
    <div class="wrap">
        <div class="email-notification">
            <div class="alert alert-success">
                Mot de passe oublié ? Pas de problème.
                <br><br>
                Indiquez votre adresse mail et nous vous transmettrons un lien pour en choisir un nouveau.
            </div>

            <!-- Session Status -->
            {{--
            <x-auth-session-status class="mb-4" :status="session('status')"/>
            --}}
            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-header">
                    <h3>Initialisation du mot de passe</h3>
                </div>
                <!-- Email Address -->
                <div class="form-group">
                    <input class="form-input" id="email" type="email" name="email" value="{{old('email')}}"
                           required
                           autofocus placeholder="Votre adresse mail"/>
                </div>
                <div class="form-group">
                    <button class="form-button" type="submit">Mail initialisation mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</x-guest>
