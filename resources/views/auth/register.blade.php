<x-layout>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">REGISTRATI!</h1>

                <!-- PER GLI ERRORI -->
                @if ($errors->any())
                    <div class="alert alert-denger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach    
                        </ul>
                    </div>
                @endif    

                <!-- FORM PER REGISRARSI -->
                <form action="{{route('register')}}" method="POST">
                    @csrf

                    <!-- imput-name -->
                    <div class="mb-3">
                        <label for="name" class="from-label">nome completo</label>
                        <input name="name" type="text" class="from-control" id="name" aria-describeby="name">
                    </div>
                    <!-- imput-email -->
                    <div class="mb-3">
                        <label for="exampleImputEmail" class="from-label">Email address</label>
                        <input name="email" type="email" class="from-control" id="exampleImputEmail">
                    </div>
                    <!-- imput-password -->
                    <div class="mb-3">
                        <label for="exampleImputPassword" class="from-label">Password</label>
                        <input name="password" type="password" class="from-control" id="exampleImputPassword">
                    </div>
                    <!-- imput-password_confirmation -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="from-label">conferma passord</label>
                        <input name="password_confirmation" type="password" class="from-control" id="password_confirmation">
                    </div>

                    <!-- bottone per registrarsi -->
                    <button type="submit" class="btn btn-primary">REGISTRATI</button>

                </form>

            </div>
        </div>
    </div>

</x-layout>