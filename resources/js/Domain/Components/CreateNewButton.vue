<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import CreateFolderModal from "@/Domain/Components/CreateFolderModal.vue";
import {ref} from "vue";

const createFolderModal = ref(false)

function showCreateFolderModal()
{
    createFolderModal.value = true;
}

</script>

<template>
    <div>
        <Dropdown align="left">
            <template #trigger>
                <PrimaryButton class="w-full">Create New</PrimaryButton>
            </template>
            <template #content>
                <DropdownLink as="button" @click="showCreateFolderModal">Folder</DropdownLink>
                <DropdownLink as="button">Upload File</DropdownLink>
            </template>
        </Dropdown>
    </div>
    <CreateFolderModal v-model="createFolderModal" />
</template>

<style scoped>

</style>
