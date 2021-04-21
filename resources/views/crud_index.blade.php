@extends('layouts.layoutbo')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Liste des utilisateurs</h2>
        </div>
        <div>
            <a class="btn btn-success" style="color:white; text-decoration:none; float: right;"
                href="{{ route('users.create') }}">Créer un nouvel utilisateur</a>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation d'envoi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <h5 class="text-center">Êtes-vous sûr de vouloir envoyer un mail à l'adresse <span
                            class="email"></span> ?</h5>
                    <div class="modal-footer">
                        <button type="submit" form="#" class="btn btn-success">Oui</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Non</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End modal -->


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Date et heure de création </th>
        <th width="420px">Action</th>
    </tr>
    @foreach ($users as $user)
    {{-- {{ dd($users)}} --}}

    <tr>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>@if ($user->is_admin == 0)
            Utilisateur
            @else
            Administrateur
            @endif
        </td>
        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
        <td style="display:flex">
            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                @csrf
                <a class="btn btn-info" style="color:white; text-decoration:none;"
                    href="{{ route('users.show',$user->id) }}">Voir</a>
                <a class="btn btn-primary" style="color:white; text-decoration:none;"
                    href="{{ route('users.edit',$user->id) }}">Éditer</a>
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>

            <form action="{{ route('mailSent') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" data-mail="{{ $user->email }}"
                    title="mailer les identifiants à l'utilisateur {{ $user->firstname }} {{ $user->name }}"
                    class="btn btn-dark btnModal" style="color:white; margin-left: 2px;">Mailer les
                    identifiants</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>
{{ $users->links() }}

<script>
    // $('.btnModal').click(function () {
    //     $('#Modal').modal();
    //      var email = $('.btnModal').data('email');
    // //     console.log(email);    
    //      $('.email').text(email);
    // });


</script>


@endsection