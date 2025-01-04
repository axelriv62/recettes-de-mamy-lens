<!-- resources/views/components/menu.blade.php -->
<nav>
    @guest
        <button class="bouton"><a href="{{route('accueil')}}"><i class="fa-solid fa-house"></i>🏠 Accueil</a></button>
        <button class="bouton"><a href="{{route('presentation')}}"><i class="fas fa-info"></i>ℹ️ Présentation</a></button>
        <button class="bouton"><a href="{{route('contact')}}"><i class="fas fa-envelope"></i>✉️ Contact</a></button>
    @endguest
    @auth
        <button class="bouton"><a href="{{route('home')}}"><i class="fa-solid fa-house"></i>🏠 Accueil</a></button>
        <button class="bouton"><a href="{{route('presentation')}}"><i class="fas fa-info"></i>ℹ️ Présentation</a></button>
        <button class="bouton"><a href="{{route('contact')}}"><i class="fas fa-envelope"></i>✉️ Contact</a></button>
        <button class="bouton"><a href="{{route('recettes.index')}}"><i class="fas fa-table-list"></i>📜 Recettes</a></button>
        <button class="bouton"><a href="{{route('ingredients.index')}}"><i class="fas fa-table-list"></i>🥣 Ingrédients</a></button>
    @endauth
    @guest
        <div class="a-droite">
            <button class="bouton"><a href="{{route('register')}}"><i class="fas fa-id-card"></i>📝 Enregistrement</a></button>
            <button class="bouton"><a href="{{route('login')}}"><i class="fas fa-right-to-bracket"></i>🔑 Connexion</a></button>
        </div>
    @endguest
    @auth
        <div class="a-droite">
            <span class="user-name">{{Auth::user()->name}}</span>
            <button class="bouton"><a href="#" id="logout"><i class="fas fa-right-from-bracket"></i>🚪 Logout</a></button>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <script>
            document.getElementById('logout').addEventListener("click", (event) => {
                document.getElementById('logout-form').submit();
            });
        </script>
    @endauth

</nav>
