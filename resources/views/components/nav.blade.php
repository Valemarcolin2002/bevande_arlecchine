<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <!-- logo navbar -->
    <a class="navbar-brand" href="#">Navbar</a>

    <!-- bottone per quando si rimpocciolisce lo schermo -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- contenuto nel bottone quando si rimpoccilisce -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <!-- home -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('welcome')}}">Home</a>
        </li>

        <!-- tutti gli annunci -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('announcements.index')}}">Tutti gli annunci</a>
        </li>

        <!-- CATEGORIE -->
        <li class="nav-item dropdown">
          <!-- bottone dropdown -->
          <a class="nav-link dropdown-toggle" href="#" id="categoriesDripdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorie
          </a>
          <!-- lista categorie -->
          <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
            @foreach ($categories as $category)
              <li>
                <a class="dropdown-item" href="{{route('categoryShow', compact('category'))}}">{{($category->name)}}</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            @endforeach
          </ul>
        </li>

        <!-- CREA ANNUNCIO -->
        @guest
        <div class="none"></div>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{route('announcements.create')}}">crea annuncio</a>
        </li>
        @endguest

        <!-- LOGIN/REGISTER -->

        <!-- se l'utente non è loggato -->
        @guest
        <!-- register -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">registrati</a>
        </li>
        <!-- login -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">login</a>
        </li>

        <!-- se l'utente è loggato -->
        @else
        <!-- nome utente -->
        <li class="nav-item">
          <a class="nav-link">{{Auth::user()->name}}</a>
        </li>
        <!-- bottone logout -->
        <li>
          <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-danger" type="submit">LOGOUT</button>
          </form>
        </li>

        @endguest

      </ul>  

    </div>

  </div>

</nav>