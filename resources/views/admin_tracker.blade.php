@extends('layouts.layoutbo')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Tracker</h2>
        </div>
    </div>
</div>

{{-- <div style="display: flex; align-items:center; justify-content:center;">
    <div id="container" style="width: 500px; height: 400px; text-align: center; margin-right:30px;"></div>
    <div id="container2" style="width: 500px; height: 400px; text-align: center;  margin-right:30px;"></div>
    <div id="container3" style="width: 500px; height: 400px; text-align: center;  margin-right:30px;"></div>
</div> --}}

<table id="myTable" class="table table-bordered" style="margin-top:50px;">
    <thead>
        <tr>
            <th>Statut</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Navigateur</th>
            <th>Système</th>
            <th>Terminal</th>
            <th>Dernière activité</th>
        </tr>
    </thead>
    <tbody id="sessions">
    </tbody>
</table>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        function getSessions() {
            $.ajax({
                type: 'GET',
                url: '{{ route('ajax') }}',
                dataType: 'html',
                success : function (data) {
                    $("#sessions").html(data);
                    console.log('OK');
                }
            })
            .fail(function (data) {
            console.log(data.responseText);
            })
            setTimeout(getSessions, 5000);
        }
    getSessions();
    });


    // $(document).ready( function () {
    //     $('#myTable').DataTable({
    //         ajax: {
    //             type: 'GET',
    //             url: '{{ route('ajax') }}',
    //             dataType: 'html',
    //             success: function (data) {
    //                 $("#sessions").html(data);
    //                 console.log('ok');
    //             }
    //         }
    //         .fail(function (data){
    //             console.log(data.responseText);
    //         })
    //         setInterval( function () {
    //             $('#myTable').ajax.reload(null, false);
    //             },5000);
    //     });       
    // });

   
   

    
</script>
@endsection