<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import FooterBar from "@/Components/Footer.vue";
</script>

<template>
<!--    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">-->
<!--        <div>-->
<!--            <Link href="/">-->
<!--                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
<!--            </Link>-->
<!--        </div>-->

<!--        <div-->
<!--            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"-->
<!--        >-->
<!--            <slot />-->
<!--        </div>-->
<!--    </div>-->
    <div class="pt-14 md:pt-32 pb-6 px-4 md:px-0">
        <header class="max-w-lg mx-auto">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </header>
        <div>
            <slot/>
        </div>
        <footer-bar></footer-bar>
    </div>
</template>
