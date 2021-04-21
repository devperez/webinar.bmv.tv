@extends('layouts.layoutbo')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Créer un nouvel utilisateur</h2>
        </div>
        <div>
            <a class="btn btn-primary" style="color:white; text-decoration:none; float: right;"
                href="{{ route('users.index')}}">Retour</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Aïe !</strong> Il y a un problème avec vos données.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prénom:</strong>
                <input type="text" name="firstname" class="form-control" placeholder="Prénom" value="{{ old('firstname') }}">
            </div>
            <div class="form-group">
                <strong>Nom:</strong>
                <input type="text" name="name" class="form-control" placeholder="Nom" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <strong>Mot de passe:</strong>
                <input type="text" name="password" class="form-control" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <strong>Cette personne a les droits administrateur</strong>
                <input type="checkbox" name="is_admin"><br />
                <!-- <strong>Cette personne n'a pas les droits administrateur</strong> -->
                <input type="checkbox" style="display:none" value="1" name="is_admin">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </div>

</form>


@endsection