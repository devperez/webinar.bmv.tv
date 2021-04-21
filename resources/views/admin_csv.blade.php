@extends('layouts.layoutbo')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <h2>Importer un fichier CSV</h2>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('import_parse') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                        <label for="csv_file" class="col-md-4 control-label">Fichier CSV à importer</label>

                        <div class="col-md-6">
                            <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                            @if ($errors->has('csv_file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="separator" value="," checked> Le séparateur est une
                                    virgule
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="separator" value=";"> Le séparateur est un
                                    point-virgule
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Parcourir le fichier CSV
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection