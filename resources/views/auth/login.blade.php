<x-layout>

    <!-- PER GLI ERRORI -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach    
            </ul>
        </div>
    @endif 


    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">LOGIN!</h1>

                <!-- FORM PER LOGGARSI -->
                <form action="{{route('login')}}" method="post">
                    @csrf

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

                    <!-- bottone per loggarsi -->
                    <button type="submit" class="btn btn-primary">LOGIN</button>

                </form>

            </div>
        </div>
    </div>

</x-layout>