<script setup>

import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    search: ''
})

</script>

<template>
    <div class="w-full">
        <form action="">
            <TextInput class="w-full"
                       v-model="form.search"
                       autocomplete
                       placeholder="Search for files and folders"/>
        </form>
    </div>
</template>

<style scoped>

</style>
