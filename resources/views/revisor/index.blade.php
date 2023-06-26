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
                    <div id="gallery" class="bg-white" ">

                        <!-- immagini -->
                        @if ($announcement_to_check->images)                          
                            @foreach($announcement_to_check->images as $image)
                                <div class="card-mb-3">
                                    <div class="row p-2">
                                            <!-- IMMAGINE -->
                                        <div class="col-12 col-md-6">
                                            <img src="{{$image->getUrl(400,300)}}" alt="..." class="img-fluid p-3 rounded">
                                        </div>
                                        <!-- ANALISI IMMAGINE -->
                                        <div class="col-md-3 border-end">
                                            <h5 class="tc-accent mt-3 border-end">Tags</h5>
                                            <div class="p-2">
                                                @if($image->labels)
                                                    @foreach($image->labels as $label)
                                                        <p class="d-inline">{{$label}},</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <h5 class="tc-accent">Revisione immagini</h5>
                                                <p>Adulti:
                                                    <span class="{{$image->adult}}"></span>
                                                </p>
                                                <p>Satira:
                                                    <span class="{{$image->spoof}}"></span>
                                                </p>
                                                <p>Medicina:
                                                    <span class="{{$image->medical}}"></span>
                                                </p>
                                                <p>Violenza:
                                                    <span class="{{$image->violence}}"></span>
                                                </p>
                                                <p>Contenuto Ammiccante:
                                                    <span class="{{$image->racy}}"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>          
                            @endforeach                       
                        @else
                        <!-- immagini che si vedono l'annuncio non ha immagini -->
                            <div class="card-mb-3">
                                <div class="row p-2">
                                    <div class="col-12 col-md-6">
                                        <img src="https://picsum.photos/200" alt="..." class="img-fluid p-3 rounded">
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <!-- PARTI ANNUNCIO -->
                    <h5 class="card-title">Titolo: {{$announcement_to_check->title}}</h5>
                    <p class="card-text">Descrizione: {{$announcement_to_check->body}}</p>
                    <p class="card-text">Prezzo: {{$announcement_to_check->price}}€</p>
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