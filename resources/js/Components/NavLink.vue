<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'flex items-center px-10 py-3 text-white bg-blue-400 font-medium font-bold leading-5 text-indigo-800 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out rounded-r-full'
        : 'flex items-center px-10 py-3 leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
