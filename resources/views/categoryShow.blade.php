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
                            <div class="card shadow" style="width:18rem;">
                                <!-- immagine dell'annuncio-->
                                <img src="https://picsum.photos/200" alt="..." class="card-img-top p-3">
                                <!-- corpo dell'annuncio -->
                                <div class="card-body">
                                    <h5 class="card-title">{{$announcement->title}}</h5>
                                    <p class="card-text">{{$announcement->body}}</p>
                                    <p class="card-text">{{$announcement->price}}€</p>
                                    <a href="{{route('announcements.show', compact('announcement'))}}" class="btn btn-primary shadow">visualizza</a> 
                                    <p class="card-footer">Pubblicato il: {{$announcement->created_at->format('d/m/Y')}}</p>
                                    <a href="" class="card-footer">Autore: {{$announcement->user->name ?? ''}}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>Non sono presenti anuci per questa categoria!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-layout>