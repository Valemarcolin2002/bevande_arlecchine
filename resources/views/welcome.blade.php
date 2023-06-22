<x-layout>

    <div class="css">prova css </div>
    
    <!-- messaggio -->
    @if (session()->has('message'))
        <div class="flex flex-row justify-center my-2 alert alert-success">
            {{session('message')}}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">

                <h1>HOME</h1>

                <!-- annunci più recenti -->
                <div class="container">

                    <!-- sottotitolo -->
                    <p class="h2 my-2 fw-bold">Ecco i nostri ultimi annunci</p>

                    <!-- ultimi annunci -->
                    <div class="row">
                        @forelse ($announcements as $announcement)
                            <div class="col-12 col-md-4 my-4">
                                <x-card :announcement="$announcement"/>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning py-3 shadow">
                                    <p class="lead">Non ci sono annunci</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-layout>