<script setup>

import NavLink from "@/Components/NavLink.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import {Link} from "@inertiajs/vue3";
import CreateNewButton from "@/Domain/Components/CreateNewButton.vue";
</script>

<template>
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 max-w-[300px]">
        <div class="h-[80px] flex items-center gap-3 px-6">
            <Link :href="route('home')">
                <ApplicationMark class="block h-9 w-auto" />
            </Link>

            File Manager
        </div>

        <div>
            <div class="px-3">
                <CreateNewButton />
            </div>

            <div class="py-3">
                <NavLink :href="route('home')" :active="route().current('home')">My Files</NavLink>
                <NavLink :href="route('shared')" :active="route().current('shared')">Shared with me</NavLink>
                <NavLink href="/">Shared by me</NavLink>
                <NavLink :href="route('trash')" :active="route().current('trash')">Trash</NavLink>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
