<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    logoPath: String,
})

const form = useForm({
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const isShown = ref(false);

const toggleShowPassword = () => {
    isShown.value = !isShown.value;
}
</script>

<template>
    <Head title="Log in" />

    <div class="login-left flex min-h-screen">
        <div class="w-1/2">
            <div class="h-screen flex items-center justify-center flex-col">
                <div class="wrapper">
                    <div class="mpbsff">
                        <ul class="dynamic-txts text-4xl text-white font bold">
                            <li class="text-center"><span>Select VoiceCom</span></li>
                            <li><span>Phishing Simulation Tracker</span></li>
                        </ul>
                    </div>
                </div>

                <img src="/images/New notifications-pana.svg" alt="login-art" class="w-[400px]" />
            </div>
        </div>

        <div class="w-1/2 bg-white flex-col  ">
            <div class="max-w-md mx-auto mt-48">

                <form @submit.prevent="submit" class="px-2 py-4">
                    <div>
                        <img src="/images/SVC Wordmark Logo Blue.png"alt="logo" class="w-80 mx-auto mb-8" />
                    </div>
                    
                    <div>
                        <h4 class="text-2xl font-semibold">Sign in</h4>
                    </div>

                    <div class="mt-4">

                        <div class="relative">

                            <span class="text-gray-400 absolute left-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full pl-9 py-1.5"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="Email Address"
                            />
                        </div>

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">

                        <div class="relative">


                            <span class="text-gray-400 absolute left-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                                </svg>                                  
                            </span>

                            <TextInput
                                id="password"
                                :type="isShown ? 'text' : 'password'"
                                class="mt-1 block w-full pl-9 py-1.5"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="Password"
                            />
                            
                        </div>

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="show-password" v-model:checked="isShown" />
                            <span class="ms-2 text-sm text-gray-600 select-none">Show password</span>
                        </label>
                    </div>

                    <div class="block mt-4">
                        <button type="submit" class="w-full text-sm font-medium bg-sky-600 py-2.5 text-white rounded-lg cursor-pointer hover:bg-sky-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Sign in
                        </button>
                    </div>

                    <!-- <div class="flex items-center justify-end mt-4">
                        <Link
                            :href="route('password.request')"
                            class="text-sm text-gray-600 hover:text-gray-900 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Forgot your password?
                        </Link>
                    </div> -->
                </form>
            </div>

        </div>
    </div>
</template>

<style scoped>
.login-left {
    background-color: #087EC1;
}

.mpbsff {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    display:flex;
    align-items: center;
    justify-content: center;
}

.wrapper {
display: flex;
}

.wrapper .dynamic-txts {
    line-height: 90px;
    height: 90px;
    overflow: hidden;
}

.dynamic-txts li {
    list-style: none;
    color: #fff;
    position: relative;
    font-weight: 500;
    top: 0;
    position: relative;
    animation: slide 9s steps(2) infinite;
}

.dynamic-txts li {
    position: relative;
}

@keyframes slide {
    100% {
        top: -180px;
    }
}

.dynamic-txts li::after {
    content: "";
    position: absolute;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #087EC1;
    border-left: 2px solid #fff;
    animation: typing 4.5s steps(15) infinite;
}

@keyframes typing {
    40%,
    60% {
        left: calc(100% + 30px);
    }
    100% {
        left: 0,
    }
}
</style>