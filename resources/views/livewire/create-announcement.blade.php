<div>

    <h1>CREA il tuo ANNUNCIO</h1>

    <!-- FORM per la CREAZIONE dell'ANNUNCIO -->
    <form wire:submit.prevent="store">
        @csrf

        <!-- input per il TITOLO -->
        <div class="mb-3">

            <label for="title">Titolo annuncio</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror"></input>

            <!-- messaggio di errore -->
            @error('title')
                {{$message}}
            @enderror

        </div>

        <!-- input per il BODY -->
        <div class="mb-3">

            <label for="body">Descrizione</label>
            <textarea wire:model="body" type="text" class="form-control @error('body') is-invalid @enderror"></textarea>

            <!-- messaggio di errore -->
            @error('body')
                {{$message}}
            @enderror

        </div>

        <!-- input per il PREZZO -->
        <div class="mb-3">

            <label for="price">Prezzo</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror"></input>

            <!-- messaggio di errore -->
            @error('price')
                {{$message}}
            @enderror

        </div>

        <!-- input per le CATEGORIE -->
        <div class="mb-3">

            <label for="category">Categoria</label>
            <select wire:model.defer="category" id="category" class="form-control">
                <option value="">Scegli la categoria</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

        </div>

        <button type="submit class="btn btn-primary shadow px-4 py-2">CREA</button>

    </form>
    
    <!-- messaggio di creazione annuncio -->
    @if (session()->has('message'))
        <div class="flex flex-row justify-center my-2 alert alert-success">
            {{session('message')}}
        </div>
    @endif

</div>
