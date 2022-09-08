<template>
    <div class="flex h-20 w-40 flex-col items-center justify-center">
        <div class="flex flex-row items-center justify-center">
        <span class="font-bold text-gray-600">{{ animalInfo }}</span>
        </div>
        <div class="mt-2 text-sm text-gray-400">{{ title }}</div>
    </div>
</template>


<script setup>

const props = defineProps(['animalInfo','title'])

</script>