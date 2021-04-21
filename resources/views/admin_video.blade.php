@extends('layouts.layoutbo')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Uploader un lien vidéo</h2>
        </div>
        <form method="POST" action="{{ route('video.update', $video->id) }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for='lien'>URL de la vidéo</label>
                <input id='lien' name='lien' required>
                <button type='submit' class="btn btn-primary">Envoyer</button>
            </div>
        </form>

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
    </div>
</div>
@endsection