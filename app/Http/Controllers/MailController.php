<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\MailTrap;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function index() 
    {
        $users = User::latest()->paginate(10);
        //dd($users);
        return view('admin_indexMail', compact('users'))->with(request()->input('page'));
    }

    public function sent(Request $request)
    {
        //dd($request);

        $id = $request->id;
        //dd($id);
        
       
        //On vérifie qu'une donnée est bien passée
        if ($id == null)
        {
            return back()->with('error',"Veuillez sélectionner au moins un utilisateur.");
        }

        //On compte le nombre de valeurs dans le tableau $id
        $ids = count(array_keys($id));
        //dd($ids);

        //S'il n'y a qu'une seule valeur
        if ($ids == 1)
        {
            //dd($id);
            $id = implode($id); //on passe le tableau en chaine de caractère pour le manipuler plus facilement
            //dd($id);
            $user = User::findOrFail($id); //On cherche l'user qui porte cet id
            //dd($user);
            $email = $user->email; //on récupère son email
            //dd($email);
            Mail::to($email)->send(new MailTrap()); //on envoie le mail

            return view('admin_mail_confirm', compact('email', 'user'));
        //sinon, le tableau contient plus d'une valeur
        }else{
            //dd($id);
            foreach ($id as $userid) { //on boucle sur le tableau pour récupérer un tableau d'ids
                //dd($id);
                $users = User::findOrFail($id); //on récupère les utilisateurs qui correspondent aux ids
                //dd($users);
            }
            foreach ($users as $user) { //on boucle sur les utilisateurs
                //dd($user->email);
                $emails[] = $user->email; //on récupère les mails dans un tableau
                Mail::to($user->email)->send(new MailTrap()); //on associe l'utilisateur à son email et on envoie
                //dd($emails);
            }     
        }
        
        return view('admin_mail_confirm', compact('emails', 'users')); //on redirige        
    }

    
}