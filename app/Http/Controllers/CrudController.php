<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        //dd($users);
        return view('crud_index', compact('users'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Input validation
        $request->validate([
            'firstname'=>'required|max:255',
            'name'=>'required|max:255',
            'password'=> 'required',
            'email'=>'required',
        ]);
        if ($request->has('is_admin')) {
        //Create new user in database
        User::create([
            'firstname'=>$request->firstname,
            'name'=>$request->name,
            'password'=> Hash::make($request->password),
            'email'=>$request->email,
            'is_admin'=> 1,
        ]);
        }else{
            User::create([
                'firstname'=>$request->firstname,
                'name'=>$request->name,
                'password'=> Hash::make($request->password),
                'email'=>$request->email,
                'is_admin'=> 0,
            ]); 
        }

        //redirect and message

        return redirect()->route('users.index')->with('success', 'Nouvel utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('crud_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('crud_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        //dd($user->id);
        //$is_admin = $request->has('is_admin') ? 1 : 0;
        //dd($is_admin);
        //on valide la requête
        $request->validate([
            'firstname'=>'required',
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
        ]);
        //$id = $user->id;
        //dd($id);
        //on met à jour l'utilisateur dans la base
        //$user->update($request->all());
        User::where('id', $id)->update([
            'firstname'=>$request->firstname,
            'name'=>$request->name,
            'password'=> Hash::make($request->password),
            'email'=>$request->email,
            'is_admin'=>$request->has('is_admin') ? true : false,
        ]);

        //on redirige
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the user
        $user = User::findOrFail($id);
        //dd($user);
        $user->delete();

        //redirect and message
        return redirect()->back()->with('success', 'L\'utilisateur a été supprimé avec succès.');
    }
}
