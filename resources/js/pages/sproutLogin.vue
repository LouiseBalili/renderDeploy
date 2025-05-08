<script setup lang="ts">
    import { Head, Link, useForm, router } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const activePage = ref(1);
    
    const setActivePage = (pageNumber : number) => {
        activePage.value = pageNumber;
    }

    let interval: number;

    onMounted(() => {
        interval = window.setInterval(() => {
            activePage.value = activePage.value < 3 ? activePage.value + 1 : 1;
        }, 5000);
    });

    const form = useForm({
        email: '',
        password: '',
    })

    const submit = () => {
        router.visit('/phished')
    };

</script>

<template>
    <Head title="Welcome to Sprout"></Head>

    <div class="max-w-full h-max-full flex">
        <div class="w-265 h-screen bg-ecru hidden md:block">

            <!-- Carousel Slider -->
            <div class="carousel relative flex flex-col min-h-screen items-center justify-center content-center space-y-6">

                <div class="loginCarousel">
                    <img v-show="activePage === 1" src="/images/login-carousel-hr-mobile.svg" alt="page 1" class="page 1">
                    <img v-show="activePage === 2" src="/images/login-carousel-readycash.svg" alt="page 2" class="page 2">
                    <img v-show="activePage === 3" src="/images/login-carousel-performance.svg" alt="page 3" class="page 3">
                </div>

                <div class="carouselTxt max-w-[500px]">
                    <div v-show="activePage === 1" class="flex flex-col space-y-6 items-center justify-center">
                        <h1 class="font-extrabold text-2xl text-center">Sprout HR on Mobile</h1>
                        <p class="text-center">Clock in and out on-the-go with a tap on your mobile phone!</p>
                    </div>

                    <div v-show="activePage === 2" class="flex flex-col space-y-6 items-center justify-center">
                        <h1 class="font-extrabold text-2xl text-center">Emergency Funds in 2 minutes!</h1>
                        <p class="text-center">Ready cash is the best way for your employees to access emergency funds when they need it most.</p>
                    </div>

                    <div v-show="activePage === 3" class="flex flex-col space-y-6 items-center justify-center">
                        <h1 class="font-extrabold text-2xl text-center">Performance and learning management, unified</h1>
                        <p class="text-center">360 feedback and instant learning opportunities; enjoy performance and learning management from our friends at HRPS.</p>
                    </div>

                    <div class="flex justify-center mt-6">
                        <Link class="font-bold text-green-600 border border-solid border-green-600 px-2 py-2 rounded-md cursor-pointer hover:bg-green-200 transition ease-in-out duration-300" href="/phished">Learn More</Link>
                    </div>
                </div>

                <div class="carouselNav space-x-2 flex flex-row absolute bottom-10">
                    <input @click="setActivePage(1)" type="radio" value="1" name="colored-radio" class="w-3 h-3 cursor-pointer appearance-none rounded-full border transition-all transition duration-300" :class="activePage === 1 ? 'border-green-400 bg-green-400' : 'border-gray-500'">
                    <input @click="setActivePage(2)" type="radio" value="2" name="colored-radio" class="w-3 h-3 cursor-pointer appearance-none rounded-full border transition-all transition duration-300" :class="activePage === 2 ? 'border-green-400 bg-green-400' : 'border-gray-500'">
                    <input @click="setActivePage(3)" type="radio" value="3" name="colored-radio" class="w-3 h-3 cursor-pointer appearance-none rounded-full border transition-all transition duration-300" :class="activePage === 3 ? 'border-green-400 bg-green-400' : 'border-gray-500'"> 
                </div>
                    
            </div>
             
        </div>

        <div class="flex h-screen w-full">
            <div class="m-auto">
                <div class="m-auto space-y-5 flex-direction-col ">
                    <div class="flex flex-col justify-center items-center space-y-5">
                        <img src="/images/Sprout-New-Logo-Black-v2.svg" class="w-12 h-12" alt="sproutLogo">
                        <label class="font-black text-2xl text-center">Sprout HR</label>
                    </div>
                    
                    <form @submit.prevent="submit" class="flex flex-col space-y-5 ">
                        <label class="font-bold text-lg">Log In</label>
                        <input type="text" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username or email" required />
                        <input type="password" v-model="form.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" required />
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-500 transition ease-in-out duration-300 cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-sm text-sm w-full sm:w-auto p-3.5 text-center font-black dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/phished">Login</button>
                        <a href="/phished" class="text-green-600 hover:underline font-bold text-sm text-center -mt-2">Forgot Password?</a>
                        <label class="text-slate-500 text-sm">© 2025 Sprout Solutions Phil., Inc. All Rights Reserved</label>
                    </form>
                </div>  
            </div>      
        </div>
        
    </div>
</template>