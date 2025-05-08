<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Phished List',
        href: '/phishedlogin/index',
    },
    {
        title: 'Edit Phished Employee',
        href: '/phishedlogin',
    },
];

const props = defineProps({
    mailinput: Object
})

const form = useForm({
    email: props.mailinput.email,
    name: props.mailinput.name,
    campaigndepartment: props.mailinput.campaigndepartment
})

const submit = async () => {
    form.put('/phishedlogin/' + props.mailinput.id)
};

</script>

<template>
    <Head title="Phished List - Edit Entry"/>

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-10 my-10 ">
            <div class="div flex flex-col mb-4">
                <div class="div">
                    <div class="h2 font-semibold text-xl text-gray-800 leading-tight">Edit Phished Employee</div>
                    <div class="p text-sm text-gray-500">View and/or edit details of the Phished Employee Entry</div>
                </div>

                <form @submit.prevent="submit" class="">
                    <div class="-ml-5">
                        <div class="px-5 py-5 flex flex-col">

                            <label class="text-sm font-medium ">Email</label>
                            <input type="text" class="border rounded-lg flex-2 px-3 py-2 mt-1 mb-5 text-sm w-1/3 text-black dark:text-white" v-model="form.email"/>
                            <div class="" v-if="form.errors.email">{{  form.errors.email }}</div>
                           
                            <label class="text-sm font-medium">Name</label>
                            <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-1/3 text-black dark:text-white" v-model="form.name"/>
                            <div class="" v-if="form.errors.name">{{  form.errors.name }}</div>
 
                            <label class="text-sm font-medium">Department/Campaign</label>
                            <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-1/3 text-black dark:text-white" v-model="form.campaigndepartment"/>
                            <div class="" v-if="form.errors.campaigndepartment">{{  form.errors.campaigndepartment }}</div>

                            <button class="border rounded-md  bg-blue-500 hover:bg-blue-400 text-white cursor-pointer w-1/3 py-1.5">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            
            
            

        </div>            
    </AppLayout>
    
</template>