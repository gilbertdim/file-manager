<script setup>

import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {ref, watch, watchEffect} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const $toast = useToast();

const form = useForm({
    name: '',
    parent_id: null
});
const page = usePage();

const folderNameInput = ref(null)

const props = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])

watch(props, () => {
    if (props.modelValue) {
        form.clearErrors();
        form.reset();
    }
});

watchEffect(() => {
    if (folderNameInput.value) {
        folderNameInput.value.focus()
    }
})

function create(event)
{
    event.preventDefault();

    form.parent_id = page.props.folder.id;
    form.put(route('folders.create'), {
        preserveScroll: true,
        onSuccess: () => {
            $toast.success('Folder created')
            close()
        },
        onError: () => folderNameInput.value.focus()
    })
}

function close()
{
    emit('update:modelValue')
}

</script>

<template>
    <Modal :show="props.modelValue" max-width="md">
        <template #title>
            Create Folder
        </template>

        <template #closeButton>
            <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </template>

        <template #content>
            <!-- Modal body -->
            <form>
                <input hidden name="csrf-token" value="{{ csrf_token() }}">

                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <InputLabel for="folderName" value="Folder" class="sr-only"/>
                        <TextInput class="w-full"
                                   v-model="form.name"
                                   ref="folderNameInput"
                                   placeholder="Folder name"/>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <PrimaryButton @click="create">Create</PrimaryButton>
                </div>
            </form>
        </template>
    </Modal>
</template>

<style scoped>

</style>
