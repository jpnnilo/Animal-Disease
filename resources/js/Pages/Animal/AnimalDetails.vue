<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'



const props = defineProps({
     animal: {
        type: Object,
        default: () => ({}),
    },
});



</script>

<template>


    <Head title="Animal" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block	">
                Animal Information
            </h2> 
          
        </template>

          <template #default>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    
                    <!-- User Profile Tab Card -->
  <div class="flex flex-row rounded-lg border border-gray-200/80 bg-white p-6">
    <!-- Avaar Container -->
    <div class="relative">
     


    </div>

    <!-- Meta Body -->
    <div class="flex flex-col px-6">
      <!-- Username Container -->
      <div class="flex h-8 flex-row">
        <!-- Username -->
          <h2 class="text-lg font-semibold">{{ animal.name }}</h2>
       

      </div>

      <!-- Meta Badges -->
      <div class="my-2 flex flex-row space-x-2">
        <!-- Badge Role -->
        <div class="flex flex-row">
          <div class="text-lg text-gray-1000">Status: <Span> Healthy</Span></div>
        </div>

      </div>

      <!-- Mini Cards -->
      <div class="mt-2 flex flex-row items-center space-x-5">
     
        <div class="flex h-20 w-40 flex-col items-center justify-center">
          <div class="flex flex-row items-center justify-center">
            <span class="font-bold text-gray-600">{{ animal.type }}</span>
          </div>
          <div class="mt-2 text-sm text-gray-400">Type</div>
        </div>

        <div class="flex h-20 w-40 flex-col items-center justify-center rounded-md ">
          <div class="flex flex-row items-center justify-center">
            <span class="font-bold text-gray-600">{{ animal.breed }}</span>
          </div>
          <div class="mt-2 text-sm text-gray-400">Breed </div>
        </div>

        <div class="flex h-20 w-40 flex-col items-center justify-center rounded-md ">
          <div class="flex flex-row items-center justify-center">
            <span class="font-bold text-gray-600">{{ animal.gender }}</span>
          </div>
          <div class="mt-2 text-sm text-gray-400">Gender </div>
        </div>

   
        <div class="flex h-20 w-40 flex-col items-center justify-center rounded-md ">
          <div class="flex flex-row items-center justify-center">
            <span class="font-bold text-gray-600">{{ animal.age }}</span>
          </div>

          <div class="mt-2 text-sm text-gray-400">Age</div>
        </div>


       
      </div>
    </div>

    <!-- Right Actions Container -->
    <div class="w-100 flex flex-grow flex-col items-end justify-start ">
      <div class="flex flex-row space-x-3">
        <!-- Follow Button -->
        <button class="flex rounded-md bg-blue-500 py-2 px-4 text-white transition-all duration-150 ease-in-out hover:bg-blue-600 ">
          <svg class="mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.1" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
          Add Disease
        </button>

       
      </div>
    </div>
  </div>
                </div>
        </template>
    </BreezeAuthenticatedLayout>



</template>
