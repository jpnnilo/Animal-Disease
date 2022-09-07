<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Animal;
use App\Models\Disease;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all();
        return Inertia::render('Animal/Index',compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=> 'required',
            'breed'=> 'required',
            'type'=> 'required',
            'gender'=> 'required',
            'age'=> 'required|numeric',
            
        ]);

        $animal = new Animal;
        $animal->name = $request->name;
        $animal->gender = $request->gender;
        $animal->type = $request->type;
        $animal->age = $request->age;
        $animal->breed = $request->breed;
        $animal->save();

        // return redirect(route('animal.index'));
    }

    public function addDisease(Request $request){
        
        
        $validate = $request->validate([
            'disease_id'=> 'required',
        ]);
        $animal = Animal::find($request->animal_id);
        $animal->diseases()->attach($request->disease_id);

    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::with('diseases')->find($id);
        foreach ($animal->diseases as $diseases) {
            $disease_array[] = $diseases->pivot->disease_id;
            //get all diseases id from pivot table then pass it to array
       }
           
       //this is to populate dropdown and check if the animal already has that disease
       if(empty($disease_array)){
           $diseases = Disease::all();
             
       }else{
           $diseases = Disease::whereNotIn('id', $disease_array)->get();
           //select all diseases id where not in id of array $disease_array
       }

       
       return Inertia::render('Animal/AnimalDetails',compact('animal', 'diseases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $validate = $request->validate([
            'name'=> 'required',
            'breed'=> 'required',
            'type'=> 'required',
            'gender'=> 'required',
            'age'=> 'required|numeric',
            
        ]);

        $animal = Animal::find($id);
        $animal->name = $request->name;
        $animal->gender = $request->gender;
        $animal->type = $request->type;
        $animal->age = $request->age;
        $animal->breed = $request->breed;
        $animal->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Animal::find($id)->delete();
    }

    public function removeDisease(Request $request)
    {   
        $animal = Animal::find($request->animal_id);
        $animal->diseases()->detach($request->disease_id);
    }   
}
