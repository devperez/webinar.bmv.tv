@extends('layouts.layoutbo')

@section('content')
@isset($email)

<h2>Un mail a été envoyé à l'utilisateur {{ $user->firstname }} {{ $user->name }} à l'adresse {{ $email }} !</h2>

@endisset

@isset($emails)

<h2>Les mails ont été envoyés aux utilisateurs suivants :</h2>
<table class="table-bordered">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Adresse email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endisset

@endsection