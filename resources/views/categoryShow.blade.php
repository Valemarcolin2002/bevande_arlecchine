<x-layout>

    <!-- nome della categoria di cui stiamo guardando gli annunci-->
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 p-5">
                <h1 class="">Esplora la categoria {{$category->name}}</h1>
            </div>
        </div>
    </div>

    <!-- ANNUNCI riguardanti tale categoria -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @forelse ($category->announcements as $announcement)
                        <div class="col-12 col-md-4 my-4">
                            <x-card :announcement="$announcement"/>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>Non sono presenti annuci per questa categoria!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-layout>