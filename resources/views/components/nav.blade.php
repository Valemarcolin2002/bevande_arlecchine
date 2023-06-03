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
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
        </li>

        <!-- lista link -->
        <li class="nav-item dropdown">
          <!-- dropdown -->
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <!-- lista link -->
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
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