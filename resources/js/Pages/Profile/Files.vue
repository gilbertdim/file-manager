<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {router} from "@inertiajs/vue3";
const {files} = defineProps({
    ancestors: Array,
    folder: Object,
    files: Object,
})

function openFolder(file) {
    if (!file.is_folder) {
        return;
    }

    router.visit(route('folder', {folder: file.path}))
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <nav class="flex items-center justify-between">
                <ol class="inline-flex items-center space-x-1 md:col-span-x-3">
                    <li v-for="ancestor in ancestors.data" :key="ancestor.id">
                        <a v-if="! ancestor.parent_id" :href="route('home')">
                            {{ ancestor.name }}
                        </a>
                    </li>
                </ol>
            </nav>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            </h2>
        </template>

        <div class="p-2">
            <div class="max-w-8xl mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <th class="py-2 bg-gray-600 text-white">Name</th>
                            <th class="py-2 bg-gray-600 text-white">Owner</th>
                            <th class="py-2 bg-gray-600 text-white">Last Modified</th>
                            <th class="py-2 bg-gray-600 text-white">Size</th>
                        </thead>
                        <tbody>
                            <tr class="cursor-pointer" v-for="file in files.data" :key="file.id"
                                @dblclick="openFolder(file)"
                            >
                                <td class="p-3">{{ file.name }}</td>
                                <td class="p-3 text-center">{{ file.owner }}</td>
                                <td class="p-3 text-center">{{ file.updated_at }}</td>
                                <td class="p-3 text-right">{{ file.size }}</td>
                            </tr>
                            <tr v-if="files.data.length == 0">
                                <td colspan="4" class="p-3 text-gray-300 italic text-lg text-center">There is no file in this filder</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
