<div class="card shadow" style="width:18rem;">
    <!-- immagine dell'annuncio-->
    <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(400,300) : 'https://picsum.photos/200'}}" alt="..." class="card-img-top p-3 rounded">
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


