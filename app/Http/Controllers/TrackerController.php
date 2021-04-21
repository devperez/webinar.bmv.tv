<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TrackerController extends Controller
{
    public function onlineUsers() {
        // Get the array of users
        $sessions = session::all();
        if(!$sessions) return null;
        // //dd(Carbon::now());
        // $log = false;
        // foreach($sessions as $session) {
        //     //dd(Carbon::now()->diffInSeconds($session->last_activity));
        //     if(Carbon::now()->diffInSeconds($session->last_activity) < 60) {
        //         $log = true;
        //     }else{
        //         $log = false;
        //     }
        // }
        //dd($log);
        return view('admin_tracker', compact('sessions'));
    }

    public function addMinute($id)
    {
        //dd($id);
        $session = session::where('user_id', $id);
        //dd($session);
        if($session){
            $session = session::where('user_id', $id)->latest()->first();
            $session->last_activity = Carbon::now()->addMinute();
            $session->save();
        }
    }

    public function ajaxSessions()
    {
        $sessions = session::all();
        //dd($sessions);
        //dd(Carbon::now());
        foreach($sessions as $session) {
            //dd(Carbon::now()->diffInSeconds($session->last_activity));
            if(Carbon::now()->diffInSeconds($session->last_activity) < 60) {
                //j'utilise temporairement payload pour stocker la valeur qui sert à afficher le statut de l'utilisateur (connecté ou non)
                $session->payload = true;
            }else{
                $session->payload = false;
            }
        }
        return view('admin_tracker_tab', compact('sessions'));
    }
}
