<form action="{{route('set_language_locale', $lang)}}" method="POST">
    @csrf
    <button type="submit" class="dropdown-item">
        <div>{{$nation}}</div>
    </button>
</form>
<li>
    <hr class="dropdown-divider">
</li>

