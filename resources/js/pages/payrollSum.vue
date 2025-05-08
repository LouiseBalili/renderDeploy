<script setup lang="ts">
    import { Head, useForm, router } from '@inertiajs/vue3';

    const form = useForm({
        email: '',
        password: '',
    })

    const submit = () => {
        form.post('/tracksubmit');
    };
</script>

<template>
    <Head title="Welcome to SVC Payroll"></Head>

    <div>
        <div class="flex h-screen w-full px-10 py-10">
            <div class="m-auto">
                <div class="m-auto space-y-5 flex-direction-col ">
                    <div class="flex flex-col justify-center items-center space-y-5">
                        <img src="/images/SVCLogo.png" class="w-20 h-16" alt="sproutLogo">
                        <label class="font-black text-2xl text-center">Sign in to view your payroll summary</label>
                    </div>
                    
                    <form @submit.prevent="submit" class="flex flex-col space-y-5 ">
                        <input type="email" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email address" required />
                        <input type="password" v-model="form.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" required />
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 transition ease-in-out duration-300 cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm text-sm w-full sm:w-auto p-3.5 text-center font-black dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/phished">Sign In</button>
                        <a href="/phished" class="text-blue-600 hover:underline font-bold text-sm text-center -mt-2">Contact IT Support</a>
                        <label class="text-slate-500 text-sm text-center">© 2025 Select Voicecom - All Rights Reserved</label>
                    </form>
                </div>  
            </div>      
        </div>
    </div>
</template>