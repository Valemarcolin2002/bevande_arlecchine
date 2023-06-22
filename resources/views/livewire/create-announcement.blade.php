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
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror

        </div>

        <!-- input per il BODY -->
        <div class="mb-3">

            <label for="body">Descrizione</label>
            <textarea wire:model="body" type="text" class="form-control @error('body') is-invalid @enderror"></textarea>

            <!-- messaggio di errore -->
            @error('body')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror

        </div>

        <!-- input per il PREZZO -->
        <div class="mb-3">

            <label for="price">Prezzo</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror"></input>

            <!-- messaggio di errore -->
            @error('price')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror

        </div>

        <!-- input per le CATEGORIE -->
        <div class="mb-3">

            <label for="category">Categoria</label>
            <select wire:model.defer="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Scegli la categoria</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <!-- messaggio di errore -->
            @error('category')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror

        </div>

        <!-- imput per le IMMAGINI -->
        <div class="mb-3">
            <input  wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images.*') is invalid @enderror" placeholder="img"></input>
            <!-- messaggio di errore -->
            @error('temporary_images.*')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        @if (!empty($images))
            <div class="row">
                <div class="col-12">
                    <p>{{__('ui.PhotoPreview')}}</p>
                    <div class="row border border- border-info rounded shadow py-4">
                        @foreach ($images as $key => $image)
                            <div class="col my-3">
                            <img src="{{$image->temporaryUrl()}}" class="img-preview mx-auto shadow rounded d-block mt-2" >
                                <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">{{__('ui.Delate')}}</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <button type="submit class="btn btn-primary shadow px-4 py-2">CREA</button>

    </form>
    
    <!-- messaggio di creazione annuncio -->
    @if (session()->has('message'))
        <div class="flex flex-row justify-center my-2 alert alert-success">
            {{session('message')}}
        </div>
    @endif

</div>
