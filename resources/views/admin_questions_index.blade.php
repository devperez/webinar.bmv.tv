@extends('layouts.layoutbo')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Les réactions</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Message / Question</th>
            <th>Heure</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody id="questions">
    </tbody>
</table>
{{ $questions->links() }}

<script>
    document.addEventListener('DOMContentLoaded', function() {
            function getQuestions() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajaxQuestions') }}',
                    dataType: 'html',
                    success : function (data) {
                        $("#questions").html(data);
                        console.log('OK');
                    }
                })
                .fail(function (data) {
                console.log(data.responseText);
                })
                setTimeout(getQuestions, 5000);
            }
        getQuestions();
        });

</script>
@endsection