@extends('layouts.layoutbo')

@section('content')
{{--{{ dd($users) }}--}}


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
					<h5 class="text-center">Êtes-vous sûr de vouloir envoyer <span class="result">0</span> mails ?</h5>
					<div class="modal-footer">
						<button type="submit" form="mails" class="btn btn-success">Oui</button>
						<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Non</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- End modal -->
<form action="{{ route('mailSent') }}" id="mails" method="POST">
	@csrf
	<div style="display: flex; justify-content: space-between;">
		<h2>Envoyer des mails</h2>
		<button id="btnsend" class="btn btn-success" type="button" data-toggle="modal" data-target="#Modal">Envoyer
			<span class="result">0</span> mails</a>
		</button>
	</div>
	<p>Nombre de personnes sélectionnées :<strong><span class="result"> 0</span></strong></p>
	@if (Session::has('error'))
	<div class="alert alert-info">{{ Session::get('error') }}</div>
	@endif
	<table class="table table-bordered">
		<form name="frm">
			<thead>
				<tr>
					<th>Sélectionner ou déselectionner<br /> tous les utilisateurs <input type="checkbox"
							id="check_all">
					</th>
					<th>Prénom</th>
					<th>Nom</th>
					<th>Adresse email</th>
					<th>Date et heure de création</th>
				</tr>
			</thead>
			@foreach ($users as $user)
			{{-- {{ dd($user->id) }} --}}
			<tbody id="checkboxes">
				<tr>
					<td><input name="id[]" value="{{ $user->id }}" type="checkbox">
					</td>
					<td>{{ $user->firstname }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
				</tr>
			</tbody>
		</form>
		@endforeach
	</table>
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
	//Sélection de toutes les checkboxes d'un seul click
	$(document).ready(function(){
		var cc = document.getElementById('check_all'); //on sélectionne la checkbox maîtresse
		var $checkboxes = $('#checkboxes input[type="checkbox"]'); //on sélectionne toutes les autres checkboxes
		$(cc).on('click', function(){ //lors du click sur la checkbox maîtresse
			if (cc.checked){ //si elle passe au statut "coché"
				$checkboxes.prop('checked', true); //toutes les autres checkboxes passent au statut "coché"
				var countCheckedCheckboxes = $checkboxes.filter(':checked').length; //on crée la variable qui stocke le nombre de checkboxes cliquées
				$('.result').text(countCheckedCheckboxes); //on affiche le résultat
			} else { //si la checkbox maîtresse passe au statut "non coché"
				$checkboxes.prop('checked', false); //toutes les checkboxes se décochent
				var countCheckedCheckboxes = $checkboxes.filter(':checked').length; //on crée la variable qui stocke le nombre de checkboxes cliquées
				$('.result').text(countCheckedCheckboxes); //on affiche le résultat
			}
		});
	});
	//Sélection des checkboxes individuellement
	$(document).ready(function(){
		var $checkboxes = $('#checkboxes input[type="checkbox"]'); //on sélectionne toutes les checkboxes
		var cc = document.getElementById('check_all'); //on sélectionne la checkbox maîtresse
		$(checkboxes).change(function(){ //lors d'un click sur une checkbox
			var countCheckedCheckboxes = $checkboxes.filter(':checked').length; //on crée la variable qui stocke le nombre de checkboxes cliquées
			$('.result').text(countCheckedCheckboxes); //on affiche le résultat
			if(countCheckedCheckboxes < $checkboxes.length) { //si le nombre total de checkboxes cliquées est inférieur au nombre total de checkboxes alors on décoche la checkbox maîtresse
				$(cc).prop('checked', false);
			}
		})
	});



</script>