<x-guest>
    <div class="wrap">
        <form class="login-form" action="{{ url('reset-password') }}" method="post">
            @csrf
            <div class="form-header">
                <h3>Initialisation du mot de passe</h3>
            </div>

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!--Email Input-->
            <div class="form-group">
                <input type="text" name="email" class="form-input"
                       value="{{old('email', $request->email)}}" placeholder="email@exemple.com">
            </div>
            <!--Password Input-->
            <div class="form-group">
                <input type="password" name="password" class="form-input" placeholder="mot de passe">
            </div>
            <!--Confirm Password Input-->
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-input"
                       placeholder="Confirmez mot de passe">
            </div>


            <div class="form-group">
                <button class="form-button" type="submit">Init mot de passe</button>
            </div>
        </form>
    </div>
</x-guest>
