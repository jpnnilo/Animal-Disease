<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
import { reactive } from 'vue';


const props = defineProps({
    diseases: Array,
    // form:{},
});



let form = useForm({
    id:'',
    name:'',
    description: '',
    

});

let isActive = ref(false);
let modalTitle = '';

function destroy(diseaseId){
    form.delete(route('disease.destroy', diseaseId));
}

function create(){
    modalTitle = 'Create disease';
    console.log(modalTitle);
    form.id = "";
    form.name = "";
    form.description = "";
}

function store(){
    console.log(form);
    form.post(route('disease.store',form)); 
} 

function edit(disease){
    console.log(disease);
    modalTitle = "Update disease";
    form.id = disease.id;    
    form.name = disease.name;
    form.description = disease.description;
 
}

function update(diseaseId){
    form.put(route('disease.update', diseaseId)); 
} 

function save(){
    if(form.id){
        update(form.id)
    }else{
        store()
        create()
    }

}


</script>

<template>

<div class="container mx-auto">
    <div class="flex justify-center ">
      <div
        v-show="isActive"
        class=" absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 " @click.self="isActive = false" >
        
        <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl w-screen">
            
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl">{{ modalTitle }}</h3>
                    
                    <svg
                    @click="isActive = false"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-red-900 cursor-pointer"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                        </svg>
                </div>
            <form @submit.prevent="save">
                <div class="my-3">
                    <label for="email" class="mb-3 block text-base font-medium text-[#07074D]" >
                        Name:
                    </label>
                    <input type="text" v-model="form.name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                </div>
                <div v-if="form.errors.name">{{ form.errors.name }}</div>

                <div class="my-3">
                    <label for="breed" class="mb-3 block text-base font-medium text-[#07074D]" >
                        Description:
                    </label>
                    
                    <textarea v-model="form.description" cols="40" rows="5" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>

                </div>
                <div v-if="form.errors.description">{{ form.errors.description }}</div>
                
                <div class="mt-4">
            
                    <button
                    @click="isActive = false"
                    class="px-6 py-2 text-blue-800 border border-blue-600 rounded"
                    >
                    Cancel
                    </button>
                    <button type="submit" class="px-6 py-2 ml-2 text-blue-100 bg-blue-600 rounded">
                    Save
                    </button>
                
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>



    <Head title="Disease"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
                List of Disease   
            </h2> 
           

        </template>

          <template #default>
                
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <button @click="isActive = true, create(), modalTitle ='Create Disease'" class="flex rounded-md bg-blue-500 py-2 px-4 mb-2 text-white transition-all duration-150 ease-in-out hover:bg-blue-600 block float-right" >
                        <svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                        Create Disease
                    </button>
                    <table class="min-w-max w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-lg leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Description</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-lg font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100" v-for="disease in diseases" :key="disease">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        
                                        <span class="font-medium">{{ disease.name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left text-base ">
                                    <div class="flex items-center ">
                                        
                                        <span >{{ disease.description }}</span>
                                    </div>
                                </td>
                        
                              
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                               
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer" @click="isActive = true , edit(disease), modalTitle ='Update Disease'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer" @click="destroy(disease.id)">
                                           
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
