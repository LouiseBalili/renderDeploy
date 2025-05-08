<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Modal from '@/components/Modal.vue'
import DangerButton from '@/components/DangerButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import Pagination from '@/components/Pagination.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Phished Employee',
        href: '/phishedlist/index',
    },
];

const props = defineProps({
    clicks: Object,
    flash: Object,
})

    let showConfirm = ref(false);
    let selectedDeleteEntry = null;
    let deleteForm = useForm({});

    function remove(click) {
        selectedDeleteEntry = click;
        showConfirm.value = true;
    }

    function deleteEntry(){
        deleteForm.delete('/phishedlist/' + selectedDeleteEntry.id)
        showConfirm.value = false;
    }

    function closeModal(){
        showConfirm.value = false;
    }

    onMounted(() => {
    // Set a timeout to hide the success flash message after 3 seconds
        const successFlashMessage = document.getElementById('flash-success-message');
            if (successFlashMessage) {
                setTimeout(() => {
                successFlashMessage.style.display = 'none';
                }, 3000);
        }

        // Set a timeout to hide the error flash message after 3 seconds
        const errorFlashMessage = document.getElementById('flash-error-message');
            if (errorFlashMessage) {
                setTimeout(() => {
                errorFlashMessage.style.display = 'none';
            }, 3000);
        }
    });
</script>

<template>
  <Head title="Phished List" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="mx-10 my-10 ">
            <div class="div flex items-end justify-between mb-4">
                <div class="div">
                    <div class="h2 font-semibold text-xl text-gray-800 leading-tight">Phished Employees (Link Clicked)</div>
                    <div class="p text-sm text-gray-500">List of employees who clicked on the url of the phishing simulation.</div>
                </div>
            </div>

            <!-- Table that display the list of employees who clicked on the link of the phishing simulation -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                               Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department/Campaign
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Timestamp
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="click in clicks.data" :key="click.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ click.email }}
                            </th>
                            <td class="px-6 py-4">
                                {{ click.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ click.campaigndepartment }}
                            </td>
                            <td class="px-6 py-4">
                                {{ click.clicked_at }}
                            </td>
                            <td class="flex flex-row justify-start ml-6 space-x-2.5 cursor-pointer overflow-hidden">
                                <Link :href="'/phishedlist/edit/' + click.id">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 hover:scale-110 hover:text-blue-400 my-4.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </Link>

                                <svg @click="remove(click)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 hover:scale-110 hover:text-blue-400 my-4.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <Modal :show="showConfirm" @close="closeModal">
                    <div class="p-4 sm:p-10 text-center overflow-y-auto">
                        <span class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 border-red-50 bg-red-100 text-red-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                            </svg>
                        </span>

                        <h3 class="mb-2 text-2xl font-bold text-gray-800">
                            Delete Entry
                        </h3>
                        <p class="text-gray-500">
                            Are you sure you want like to delete this Entry?
                        </p>

                        <p class="mt-5"> {{ selectedDeleteEntry?.email }} | {{ selectedDeleteEntry?.name }} | {{ selectedDeleteEntry?.campaigndepartment }}</p>

                        <div class="mt-6 flex justify-center gap-x-4">
                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                            <DangerButton @click="deleteEntry()">Delete</DangerButton>
                        </div>
                    </div>
                </Modal>

            </div>

            <!-- <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.success }}
                <div class="progress-bar success"></div>
            </div>

            <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.error }}
                <div class="progress-bar error"></div>
            </div> -->

            <!-- Pagination -->
            <Pagination v-if="clicks.data.length>0" :links="clicks.links" class="mt-6 flex justify-center"/>

        </div>
        
    </AppLayout>
</template>

<style scoped>
#flash-success-message {
    animation: fadeOut 7s ease-in-out forwards;
}

#flash-error-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.success .progress-bar {

animation: progressBar 5s linear;
}
.error .progress-bar {
background-color: #FF5733; /* Red color */
animation: progressBar 5s linear;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

@keyframes progressBar {
    0% {
        width: 100%;
    }
    100% {
        width: 0;
    }
}
</style>