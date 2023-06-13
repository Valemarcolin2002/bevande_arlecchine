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
                        @foreach ($announcements as $announcement)
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
                                        <a href="{{route('categoryShow', ['category'=>$announcement->category])}}" class="my-2 border-top pt-2 border-dark card-link shadow btn btn-success">Categoria: {{$announcement->category->name}}</a> 
                                        <p class="card-footer">Pubblicato il: {{$announcement->created_at->format('d/m/Y')}}</p>
                                        <a href="" class="card-footer">Autore: {{$announcement->user->name ?? ''}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-layout>