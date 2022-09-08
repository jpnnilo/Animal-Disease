<script setup>

import Swal from 'sweetalert2';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
import { reactive } from 'vue';
import AnimalForm from './AnimalForm.vue';

const props = defineProps({
    animals: Array,
});


let form = useForm({
    id:null,
    name:null,
    age: null,
    breed:null,
    type:null,
    gender:null,
});

let isActive = ref(false);
let modalTitle = '';


function create(){
  form.reset()
}

function store(){
    console.log(form);
    form.post(route('animal.store'), {
        onSuccess: (response) => {console.log(response);
        Swal.fire(
            'Animal has been created!',
            'Success!',
            'success'
        )
        },
    }); 
    

} 

function edit(animal){
    console.log(animal);
    form.id = animal.id;    
    form.name = animal.name;
    form.age = animal.age;
    form.gender = animal.gender;
    form.type = animal.type;
    form.breed = animal.breed;
}

function update(animalId){
    form.put(route('animal.update', animalId), {
        onSuccess: (response) => {
            Swal.fire(
                'Animal has been updated!',
                'Success!',
                'success'
            )
        },
    }); 
    
} 

function destroy(animalId){
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        form.delete(route('animal.destroy', animalId));
        Swal.fire(
        'Deleted!',
        'Animal has been deleted.',
        'success'
        )
    }
    })
    
}

function save(){
    if(form.id){
        update(form.id)
    }else{
        store()
        create()
    }
    form.reset()
}


</script>


<template>

<AnimalForm :modalTitle="modalTitle" :form="form" :isActive="isActive" @isActive="isActive = false" @save="save"></AnimalForm>
   
    <Head title="Animal" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
                List of Animal   
            </h2> 
           

        </template>

          <template #default>
                
                <div class="max-w-7xl mx-auto my-5 py-6 px-4 sm:px-6 lg:px-8 bg-white shadow">
                    <button @click="isActive = true, create(), modalTitle = 'Create Animal'" class="flex rounded-md bg-blue-500 py-2 px-4 mb-2 text-white transition-all duration-150 ease-in-out hover:bg-blue-600 block float-right" >
                        <svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                        Create Animal
                    </button>
                    <table class="min-w-max w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-lg leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Type</th>
                                <th class="py-3 px-6 text-center">Breed</th>
                                <th class="py-3 px-6 text-center">Gender</th>
                                <th class="py-3 px-6 text-center">Age</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-lg font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="animal in animals" :key="animal">
                                <td class="py-3 px-6 text-left ">
                                    <div class="flex items-center">
                                        
                                        <span class="font-medium">{{ animal.name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ animal.type }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ animal.breed }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ animal.gender }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ animal.age }}
                                </td>
                              
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                            <Link :href="route('animal.show', animal.id)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </Link>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer" @click="isActive = true , edit(animal), modalTitle = 'Edit Animal'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer" @click="destroy(animal.id)">
                                           
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                             
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
        </template>
    </BreezeAuthenticatedLayout>



</template>
