<x-layout>
    
    <!-- titolo pagina  -->
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 test-light p-5">
                <h1>{{$announcement_to_check ? 'Ecco l\'annuncio da revisionare' : 'Non ci sono annunci da revisionare'}}</h1>
            </div>
        </div>
    </div>

    <!-- ANNUNCI da REVISIONARE -->
    @if($announcement_to_check)

        <div class="container">

            <!-- ANNUNCI -->
            <div class="row">
                <div class="col-12">

                    <!-- CAROSELLO IMMAGINI -->
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

                    <!-- PARTI ANNUNCIO -->
                    <h5 class="card-title">Titolo: {{$announcement_to_check->title}}</h5>
                    <p class="card-text">Descrizione: {{$announcement_to_check->body}}</p>
                    <p class="card-footer">Pubblicato il: {{$announcement_to_check->created_at}}
                    </p>

                </div>
            </div>

            <!-- PULSANTI per ACCETTARE o RIFIUTARE -->
            <div class="row">

                <!-- ACCETTA -->
                <div class="col-12 col-md-6">
                    <form action="{{route('revisor.accept_announcement', ['announcement'=>$announcement_to_check])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success shadow">Accetta</button>
                    </form>
                </div>

                <!-- RIFIUTA -->
                <div class="col-12 col-md-6">
                    <form action="{{route('revisor.reject_announcement', ['announcement'=>$announcement_to_check])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger shadow">Rifiuta</button>
                    </form>
                </div>

            </div>

        </div>

    @endif

</x-layout>