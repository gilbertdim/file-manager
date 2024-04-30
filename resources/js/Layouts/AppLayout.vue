<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Navigation from "@/Components/Navigation.vue";
import SearchForm from "@/Domain/Components/SearchForm.vue";
import UserProfile from "@/Domain/Components/UserProfile.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="h-screen bg-gray-50 flex w-full">
            <Navigation />

            <main class="flex flex-col flex-1 overflow-hidden">
                <div class="flex items-center px-2 py-4 justify-between w-full bg-white gap-2">
                    <SearchForm/>
                    <UserProfile />
                </div>
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Page Heading -->
                    <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                        <div class="py-6 px-2">
                            <slot name="header" />
                        </div>
                    </header>

                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
