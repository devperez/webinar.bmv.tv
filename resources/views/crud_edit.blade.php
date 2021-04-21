@extends('layouts.layoutbo')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Éditer un utilisateur</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"
                style="color:white; text-decoration:none; float: right;">Retour</a>
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

<form action="{{ route('users.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Nom">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prénom:</strong>
                <input class="form-control" name="firstname" placeholder="Prénom" value={{ $user->firstname }}>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input class="form-control" name="email" placeholder="email" value={{ $user->email }}>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mot de passe:</strong>
                <input class="form-control" name="password" placeholder="mot de passe" value={{ $user->password }}>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cette personne a les droits administrateur</strong>
                <input type="checkbox" name="is_admin"><br />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </div>

</form>


@endsection