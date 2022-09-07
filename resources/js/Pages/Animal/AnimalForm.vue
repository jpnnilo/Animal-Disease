<script setup>
const props = defineProps(['modalTitle','form','isActive'])

const emits = defineEmits(['isActive', 'save']);


</script>

<template>

  <div class="container mx-auto">
        <div class="flex justify-center ">
            <div v-show="isActive" class=" absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 " @click.self="emits('isActive')" >
                <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl w-screen">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">{{ modalTitle }}</h3>
                        <svg @click="emits('isActive')" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-900 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <form @submit.prevent="emits('save', form)">
                        <div class="my-3">
                            <label for="email" class="mb-3 block text-base font-medium text-[#07074D]" >
                                Name:
                            </label>
                            <input type="text" v-model="form.name" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                        </div>
                        <div v-if="form.errors.name">{{ form.errors.name }}</div>

                        <div class="my-3">
                            <label for="breed" class="mb-3 block text-base font-medium text-[#07074D]" >
                                Breed:
                            </label>
                            <input type="text" v-model="form.breed" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                        </div>
                        <div v-if="form.errors.breed">{{ form.errors.breed }}</div>
                        
                        <div class="my-3">
                            <label for="age" class="mb-3 block text-base font-medium text-[#07074D]" >
                                Age:
                            </label>
                            <input type="text" v-model="form.age" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                        </div>
                        <div v-if="form.errors.age">{{ form.errors.age }}</div>

                        <div class="my-3">
                            <label for="age"  class="mb-3 block text-base font-medium text-[#07074D]" >
                                Type:
                            </label>
                            <select v-model="form.type" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option value="">--Please select type--</option>
                                <option>Cat</option>
                                <option>Dog</option>
                            </select>
                        </div>
                        <div v-if="form.errors.type">{{ form.errors.type }}</div>

                        <div class="mt-3 mb-8">
                            <label for="age" class="mb-3 block text-base font-medium text-[#07074D]" >
                                Gender
                            </label>
                            
                            <input type="radio" name="gender" v-model="form.gender" value="Male" class=" rounded-md border border-[#e0e0e0] bg-white text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                            <label class="ml-1 mr-4">Male</label>
                            
                            <input type="radio" name="gender" v-model="form.gender" value="Female" class=" rounded-md border border-[#e0e0e0] bg-white text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"/>
                            <label class="ml-1">Female</label>
                        </div>
                        <div v-if="form.errors.gender">{{ form.errors.gender }}</div>
                        <div class="mt-4">
            
                            <button
                            @click="emits('isActive')"
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
</template>

