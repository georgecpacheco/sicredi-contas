<div class='alert {{ $errors->count() == 0 ? (session('success') ? 'alert-success' : 'hide') : 'alert-danger' }}'>
    <ul>
        @foreach ($errors->all() as $erro)
        <li>{{ $erro }}</li>
        @endforeach

        @if (session('success'))
        <li>{{ session('success') }}</li>
        @endif
    </ul>
</div>