@extends('layouts.layoutbo')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Voir l'utilisateur {{ $user->firstname }} {{ $user->name }}</h2>
        </div>
        <div>
            <a class="btn btn-primary" style="color:white; text-decoration: none; float: right;"
                href="{{ url()->previous() }}">Retour</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Prénom:</strong>
            {{ $user->firstname }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nom:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Société:</strong>
            {{ $user->company }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rôle:</strong>
            @if ($user->is_admin == 0)
            Utilisateur
            @else
            Administrateur
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Téléphone:</strong>
            {{ $user->phone }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Poste:</strong>
            {{ $user->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Animateur:</strong>
            {{ $user->animator }}
        </div>
    </div>
</div>


@endsection