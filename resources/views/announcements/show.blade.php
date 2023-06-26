<x-layout>

    <!-- titolo annuncio -->
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 test-light p-5">
                <h1>Annuncio: {{$announcement->title}}</h1>
            </div>
        </div>
    </div>

    <!-- corpo dell'annuncio -->
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- CAROSELLO -->
                <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">

                    <!-- immagini -->
                    @if ($announcement->images)
                        <div class="carousel-inner">
                            @foreach($announcement->images as $image)
                                <div class="carousel-item @if($loop->first)active @endif">
                                    <img src="{{$image->getUrl(400,300)}}" alt="..." class="img-fluid p-3 rounded">
                                </div>
                            @endforeach
                        </div>
                    @else
                    <!-- immagini che si vedono l'annuncio non ha immagini -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                            <div class="carousel-item ">
                                <img src="https://picsum.photos/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                            <div class="carousel-item ">
                                <img src="https://picsum.photos/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                        </div>
                    @endif

                    <!-- bottone vai alla precedente -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon border border-secondary bg-dark" aria-hidden="true"></span>
                        <span class="visually-hidden border border-secondary bg-dark">Previous</span>
                    </button>

                    <!-- bottone vai alla prossima -->
                    <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon border border-secondary bg-dark" aria-hidden="true"></span>
                        <span class="visually-hidden border border-secondary bg-dark">Next</span>
                    </button>

                </div>

                <!-- BODY -->
                <h5 class="card-title">Titolo: {{$announcement->title}}</h5>
                <p class="card-text">Descrizione: {{$announcement->body}}</p>
                <p class="card-text">Prezzo: {{$announcement->price}}€</p>
                <a href="{{route('categoryShow', ['category'=>$announcement->category])}}" class="my-2 border-top pt-2 border-dark card-link shadow btn btn-success">Categoria: {{$announcement->category->name}}</a> 
                <p class="card-footer">Pubblicato il: {{$announcement->created_at->format('d/m/Y')}}</p>
                <a href="" class="card-footer">Autore: {{$announcement->user->name ?? ''}}</a>

            </div>
        </div>
    </div>

</x-layout>

