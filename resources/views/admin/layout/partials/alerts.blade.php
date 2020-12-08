 @if(session()->has('info'))
    <div class="alert alert-info" role="alert">{{ session()->get('info') }}</div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-warning">
        {{ session()->get('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif