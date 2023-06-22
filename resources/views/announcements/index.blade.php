<x-layout>

    <!-- titolo pagina -->
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 test-light p-5">
                <h1>Ecco tutti i nostri annunci</h1>
            </div>
        </div>
    </div>

    <!-- annunci -->
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                    {{$announcements->links()}}
                </div>
            </div>
        </div>
    </div>

</x-layout>