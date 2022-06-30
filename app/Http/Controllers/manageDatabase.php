<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\star;
use Laravel\Ui\Presets\React;

class manageDatabase extends Controller
{
    //Permet un enregistrement sur la base de donnée d'une nouvelle fiche 
    public function store(Request $request){
       $star = new Star; 
       $star->nom = $request->nom;
       $star->prenom = $request->prenom;
       $star->description = $request->para;
       $star->image = $request->base64; 
       $star->save(); 
       return redirect()->route('home');
    }

    //detruit une fiche
    public function delete(Request $request){
        $id=$request->id; 
        $starDelete = Star::find($id)->delete();
        return redirect()->route('home');
    }
    //modifier une fiche 
    public function update(Request $request){
        $id=$request->id;
        $star = Star::find($id);
        $star->nom = $request->nom;
        $star->prenom = $request->prenom;
        $star->description = $request->para;
        $star->image = $request->base64; 
        $star->save(); 
        return redirect()->route('home');
    }
}
