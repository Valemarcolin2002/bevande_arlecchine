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
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/id/27/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/id/28/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/id/29/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                    </div>
                    <!-- bottone vai alla precedente -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <!-- bottone vai alla prossima -->
                    <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
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
