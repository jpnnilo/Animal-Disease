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

    private function validated($request){
        $validated = $request->validate([
            'name'=> 'required',
            'breed'=> 'required',
            'type'=> 'required',
            'gender'=> 'required',
            'age'=> 'required|numeric',
            
        ]);

        return $validated;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validated($request);
        Animal::create($validated);
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

        //get all disease ID
        $disease_pluck = $animal->diseases->pluck('id');

       //populate dropdown and check if the animal already has that disease
       //select all diseases id where not in id of array $disease_array
       $diseases = Disease::whereNotIn('id', $disease_pluck)->get();

       
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
        $validated = $this->validated($request);
        Animal::where('id', $id)->update($validated);
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

    public function addDisease(Request $request){
        
        
        $validate = $request->validate([
            'disease_id'=> 'required',
        ]);
        $animal = Animal::find($request->animal_id);
        $animal->diseases()->attach($request->disease_id);

    }

    public function removeDisease(Request $request)
    {   
        $animal = Animal::find($request->animal_id);
        $animal->diseases()->detach($request->disease_id);
    }  

  
}
