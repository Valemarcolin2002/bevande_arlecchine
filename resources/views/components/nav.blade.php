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
          <a class="nav-link" aria-current="page" href="{{route('announcements.index')}}">{{__('ui.allAnnouncements')}}</a>
        </li>

        <!-- CATEGORIE -->
        <li class="nav-item dropdown">
          <!-- bottone dropdown -->
          <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

        <!-- CAMBIO LINGUA -->
        <li class="nav-item dropdown">
          <!-- bottone dropdown -->
          <a class="nav-link dropdown-toggle" href="#" id="lenguagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Lingua
          </a>
          <ul class="dropdown-menu" aria-labelledby="lenguagesDropdown">
            <!-- ITALIANO -->
            <li class="nav-item">
              <x-_locale lang='it' nation='it'/>
            </li>
            <!-- INGLESE -->
            <li class="nav-item">
              <x-_locale lang='en' nation='eng'/>
            </li>
            <!-- SPAGNOLO -->
            <li class="nav-item">
              <x-_locale lang='es' nation='es'/>
            </li>           
          </ul>
        </li>

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

          <!-- PAGINA REVISORE  -->
          @if(Auth::user()->is_revisor)
            <li class="nav-item">
              <a aria-current="page" href="{{route('revisor.index')}}" class="nav-link btn btn-outline-success btn-sm position-relative">
                Zona revisore
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{App\Models\Announcement::toBeRevisionedCount()}}
                  <span class="visually-hidden">annunci da controllare</span>
                </span>
              </a>
            </li>
          @endif

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
      
      <!-- BARRA di RICERCA -->
      <form action="{{route('announcements.search')}}" method="GET" class="d-flex">
        <input name="searched" type="search" class="form-control me-2" placeholder="Search" arialabels="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

    </div>

  </div>

</nav>