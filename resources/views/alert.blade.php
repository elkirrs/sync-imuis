<div id="alert" class="alert alert-dismissible fade show" role="alert" hidden>
    <span id="alert-text"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@if (session('status'))
    <div id="alert" class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
    <span id="alert-text">
        {{ session('msg') }}
    </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->has('msg'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <span id="alert-text">
            {{ $errors->first('msg') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
