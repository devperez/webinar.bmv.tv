@extends('layouts.app')

@section('content')

<div class="embed-responsive embed-responsive-16by9" style="width:960px; height:540px; margin:auto">
    <iframe class="embed-responsive-item" src="{{ $video->lien }}" width="960" height="540" frameborder="0"
        webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<br />
<div id="wrapper" style="width:960px; height:540px; margin:auto;">
    <div id="menu">
        <h4 class="welcome">Commentez ou posez vos questions en direct ci-dessous :</h4>
    </div>
    <br />
    <form id="message" name="message" action=" {{ route('store') }} " method="POST">
        @csrf
        <input name="usermsg" type="text" id="usermsg" style="width:300px; height:35px" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer !" class="btn btn-primary" />
    </form>
    <p id="success" style="display:none">Votre participation a bien été prise en compte. Merci !</p>
    <p id="danger" style="display:none">Il y a un problème avec votre question ou votre commentaire. Le champ ne peut
        pas être vide et les liens ne sont pas autorisés. Merci de reformuler.</p>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    //Gestion des questions
    $(document).ready(function () {
        $("form").submit(function(event) {
            event.preventDefault();

            var formData = {
                usermsg: $("#usermsg").val(),
                _token: $('input[name="_token"]').val(),
            };
        //console.log(formData);
            $.ajax({
                type:"POST",
                url: '{{ route('store') }}',
                data:formData,
                dataType:"json",
                encode:true,
            }).done(function () {
                $('#usermsg').val('');
                $('#success').addClass('alert alert-success').css('display','block');
                setTimeout(function(){$('#success').fadeOut()},3000);
            }).fail(function() {
                $('#danger').addClass('alert alert-danger').css('display','block');
                setTimeout(function(){$('#danger').fadeOut()},6000);
            })
        });
    });


    // Add one minute to last_activity in sessions table
    function addMinute() {
        $.ajax({
            type: 'GET',
            url: '{{ route('status', Auth::user()->id) }}',
            success : function (data) {
            console.log('Minute ajoutée');
            }
        })
        .fail(function (data) {
            console.log(data.responseText);
        })
        setTimeout(addMinute, 60000);
    }
    addMinute();

</script>
@endsection