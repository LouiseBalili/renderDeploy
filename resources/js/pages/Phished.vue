<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { ref, onMounted, onUnmounted } from 'vue';

    let sections: HTMLElement[] = [];
    let currentSection = 0;
    let isScrolling = false;
    const visibleContents = ref<boolean[]>([]);

    function scrollToSection(index: number) {
        if (index < 0 || index >= sections.length)
            return;
        isScrolling = true;
        currentSection = index;
        sections[currentSection].scrollIntoView({ behavior: 'smooth'});

        setTimeout(() => {
            isScrolling = false;
        }, 600);
    }

    function handleWheel(event : WheelEvent) {
        if (isScrolling) {
            return;
        } if (event.deltaY > 0) {
            scrollToSection(currentSection + 1);
        } else {
            scrollToSection(currentSection - 1);
        }
    }

    function checkVisibility() {
        const contentElements = document.querySelector('.fade-in');
        contentElements.forEach((element: HTMLElement, index: number) => {
                const rect = element.getBoundingClientRect();
                if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                    if(!visibleContents.value[index]) {
                        visibleContents.value[index] = true;
                        element.classList.add('scroll-fade-in-visible');
                    }
                }
        })
    }

    function debounce(func: Function, wait: number) {
        let timeout: any;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => func(), wait);
        };
    }

    onMounted(() => {
        sections = Array.from(document.querySelectorAll('div[id^="section"]'));
        window.addEventListener('wheel', handleWheel, { passive : false });
        window.addEventListener('scroll', debounce(checkVisibility, 100));
        checkVisibility();
    });

    onUnmounted(() => {
        window.removeEventListener('wheel', handleWheel);
        window.removeEventListener('scroll', debounce(checkVisibility, 100));
    })
    
    function scrollTo(selector: string) {
        const el = document.querySelector(selector);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth'});
        }
    }
</script>

<template>
    <Head title="Phished"></Head>

    <div>
        <div id="section1" class="h-screen flex flex-row items-center justify-between space-y-2 bg-[#fca631] px-10 py-10">
            <div class="img_container fade-in scroll-fade-in">
                <img src="/images/phish hook.png" alt="Phishing hook" class="w-[600px] h-[600px] ml-5"/>
            </div>
            
            <div class="section1_content fade-in scroll-fade-in flex items-end justify-center flex-col space-y-2 mr-5">
                <h1 class="text-4xl font-extrabold text-white">Oops! You Clicked a Simulated Phishing Link!</h1>
                <p class="p1 text-white text-lg text-end mb-15">This was part of an internal <strong>phishing simulation test </strong> conducted by the<br> Compliance Team to raise awareness about cyberthreats in the workplace.</p>
                <p class="p2 text-white font-extrabold text-2xl text-end">Don't worry - no harm was done.</p>
                <p class="p3 text-white text-lg -mt-2">But this is an important learning opportunity.</p>
            
                <a href="#section2" @click.prevent="scrollTo('#section2')" class="cursor-pointer text-white font-medium mt-5 mr-5 hover:before:bg-white hover:border-blue-600 relative overflow-hidden border bg-blue-500 border-white bg-blue px-12 py-2 rounded-lg text-white-500 shadow-2xl transition-all before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 before:h-full before:w-0 before:bg-white before:transition-all before:duration-500 hover:text-blue-600 hover:shadow-blue-500 hover:before:left-0 hover:before:w-full"><span class="relative z-10">->&emsp; See What You Missed!</span></a>
            </div>

        </div>
        <div id="section2" class="h-screen relative flex flex-row items-center justify-center space-x-10 bg-[#1264c4] text-white overflow-hidden">
            <div class="absolute -left-140 bg-[#fca631] rounded-full h-[900px] w-[900px] section2SVCLogo">
                
            </div>
            <div class="absolute top-50% left-0 section2SVCLogo fade-in scroll-fade-in">
                <img src="/images/SVC Logo All White.png" alt="SVC Logo" class="w-[320px] h-[320px]">
            </div>

            <div class="card-container card1 fade-in scroll-fade-in border-white border rounded-4xl px-10 py-10 ml-87 w-[360px] max-w-md h-[500px] overflow-hidden">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-center mb-3">Why This Matters</h1>
                    <hr>
                    <p class="mt-5 text-base overflow-hidden">
                    Cyber attackers often disguise malicious emails as legitimate business messages like HR notices, payroll updates, or meeting invites — to trick people into giving up sensitive information or clicking harmful links.
                    </p>
                </div>
            </div>

           
            <div class="card-container card2 fade-in scroll-fade-in border-white border rounded-4xl px-10 py-10 w-[360px] max-w-md h-[500px] overflow-hidden">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-center mb-3">Watch Out For</h1>
                    <hr>
                    <ul class="list-disc list-inside space-y-4 mt-5 overflow-hidden text-justify">
                        <li class="justified-li">Suspicious sender addresses (e.g., hr-payroll@secure-mycompany-updates.com)</li>
                        <li class="justified-li">Urgent tone or threats</li>
                        <li class="justified-li">Unfamiliar links (hover over links before clicking!)</li>
                        <li class="justified-li">Generic greetings like "Dear User"</li>
                        <li class="justified-li">Requests for login info or attachments you weren't expecting</li>
                    </ul>
                </div>  
            </div>
            
            <div class="card-container card3 fade-in scroll-fade-in border-white border rounded-4xl px-10 py-10 w-[360px] max-w-md h-[500px] overflow-hidden">
                <h1 class="text-2xl font-bold text-center mb-3">What to Do Next Time</h1>
                <hr>
                <ul class="list-disc list-inside space-y-4 mt-5 overflow-hidden">
                    <li class="justified-li">Stop and think before clicking.</li>
                    <li class="justified-li">Check the sender and link before acting.</li>
                    <li class="justified-li">Report suspicious emails to your IT team.</li>
                    <li class="justified-li">When in doubt, don't click - confirm first.</li>
                </ul>
            </div>
           

        </div>

        <div id="section3" class="h-screen relative flex flex-row items-center justify-center px-10 py-10">
            <div class="fade-in scroll-fade-in footer">
                <p class="text-3xl/12 text-center font-bold">Thank you for participating in this simulation!<br>
                Building a security-aware workplace is a shared responsibility.</p>
            </div>

            <div class="absolute top-50% right-12 section3NavArrow fade-in scroll-fade-in">
                <a href="#section2" @click.prevent="scrollTo('#section2')" class="-mr-5 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 border border-black rounded-full px-1.5 py-1.5 cursor-pointer hover:scale-110 transform transition-transform duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
   
 
</template>
 
<style scoped>
.justified-li {
    text-align: justify;
    text-indent: -1.5em;
    padding-left: 1.5em;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    
    100% {
        opacity: 1;
    }
}

.fade-in {
    opacity: 0;
    animation: fadeIn 1s forwards; 
}

.scroll-fade-in {
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.scroll-fade-in-visible {
    opacity: 1;
}

@media only screen and (max-width: 1600px) {
    .card3 {
        margin-right: 10px;
    }

    .section1_content h1 {
        text-align: end;
    }
}

@media only screen and (max-width: 1300px) {
    .section2NavArrows {
        display:none;
    }
}

@media only screen and (max-width: 1100px) {
    .section3NavArrow {
        display: none;
    }
}

@media only screen and (max-width: 975px ) {
    #section2 {
        flex-direction: column !important;
        gap: 2.5rem !important;
    }

    .section2SVCLogo {
        display: none;
    }

    .card-container {
        margin-left: 20px;
        margin-right: 20px;
        width: 70%;
        max-width: 70% !important;
    }

    .card-container h1{
        margin-top: -25px;
    }

    .card1 {
        margin-top: 20px;
    }

    .card3 {
        margin-bottom: 20px;
    }

    .section2NavArrows {
        display: block;
        position: absolute;
        top: 40%;
        right: 30px;
    }
}

@media only screen and (max-width: 755px) {
    #section1 .img_container {
        display: none;
    }
}

@media only screen and (max-width: 700px) {
    .section1_content .p2 {
        text-align: center;
    }

    .section1_content .p3 {
        text-align: center;
    }
}

@media only screen and (max-width: 300px) {
    .section2NavArrows {
        display: none;
    }
}
</style>