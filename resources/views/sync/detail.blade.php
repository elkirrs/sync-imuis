@extends('layout')

@section('title')
    {{ __('Sync Jobs Detail') }}
@endsection

@section('content')
    <div class="row">

        @include('alert')

        <div class="col-sm-10">
            <h2 class="pb-2">{{ __("Sync Jobs Detail") }}</h2>
        </div>

        @if(is_array($detail))
            @foreach($detail as $attempt => $item)
                <div class="pt-5">
                    <p>{{ __('Attempt: ')  . ++$attempt}}</p>
                </div>
                <div class="pt-5">
                <pre class="pre-wrap">
                    {{ $item->message }}
                </pre>

                    <pre class="pre-wrap">
                    {{ $item->details }}
                </pre>
                </div>
            @endforeach

        @endif

    </div>

@endsection

@section('scripts')

@endsection
