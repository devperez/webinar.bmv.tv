<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsvData;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin_csv');
    }

    public function parse(Request $request)
    {
        //dd($request);
        //on valide la requête
        $request->validate([
            'csv_file' => 'required|file',
            'mimeType' => 'text/csv',
        ]);

        //on stocke le fichier temporairement
        $path = $request->file('csv_file')->getRealPath();
        //dd($path);
        $separator = $request->separator;
        //dd($separator);

       
        //on parcourt le fichier si le séparateur est une virgule avec cette fonction
        if ($separator == ',') {
            $data = array_map('str_getcsv', file($path));
        }elseif ($separator == ';') { //si le séparateur est un point-virgule avec cette fonction
            $data = array_map(function($data) { return str_getcsv($data, ';');}, file($path));
        }

        //dd($data);

        //on stocke le fichier en base
        $csv_data_file = CsvData::create([
            'csv_filename'=>$request->file('csv_file')->getClientOriginalName(),
            'csv_header'=>$request->has('header'),
            'csv_data'=>json_encode($data)
        ]);

        //on sélectionne les 4 premières lignes
        $csv_data = array_slice($data, 0, 4);

        return view('admin_csv_import', compact('csv_data', 'csv_data_file'));
    }

    public function process(Request $request)
    {
        //dd($request);

        //on récupère le fichier grâce à son id
        $data = CsvData::find($request->csv_data_file_id);
        //dd($data);

        //on décode le fichier et on le met sous forme de tableau avec le paramètre true
        $csv_data = json_decode($data->csv_data, true);
        //dd($csv_data);
        //on remplace les clés du précédent tableau par les valeurs et les valeurs par les clés
        $request->fields = array_flip($request->fields);
        //dd($csv_data);
        
        foreach ($csv_data as $row) {
            $user = new User();
            foreach (config('app.db_fields') as $index => $field) {
                $user->$field = $row[$request->fields[$index]];
            }
            $user->save();
        }
        return view('admin_csv_success');
    }
}
