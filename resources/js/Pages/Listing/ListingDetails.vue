<script setup>
import {Head} from "@inertiajs/vue3";
import GeneralLayout from "@/Layouts/GeneralLayout.vue";

const props = defineProps({
    model: {
        type: Object,
        required: true,
    }
})

console.log(props.model)

</script>

<template>
    <Head title="Listing Details"/>

    <GeneralLayout>
        <section class="p-8 text-center bg-gradient-to-r from-blue-200 to-purple-500 lg:p-20">
            <h1 class="mb-2 text-2xl font-bold text-gray-700 lg:text-5xl">
                Listing Details

            </h1>
            <div class="text-white">
                <span class="text-blue-800"><a :href="route('listing.index')">Home</a> / </span><span class="text-sm text-gray-100">Details</span>
            </div>
        </section>

        <section class="px-4 py-4 bg-gray-200 lg:px-20 lg:py-8">
            <div class="flex flex-wrap lg:space-x-12">

                <div class="lg:w-3/5">
                    <h1 class="mb-4 text-3xl font-medium text-left text-gray-900 lg:text-3xl">
                        {{ props.model.listing.title }}</h1>

                    <span class="mb-4 text-2xl font-extrabold text-blue-600">R{{ props.model.listing.price }}</span>

                    <img
                        src="https://images.unsplash.com/photo-1601760562234-9814eea6663a?ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cmVhbGVzdGF0ZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                        alt="property" class="w-full">
                    <div class="mt-4">
                        <h4 class="text-2xl font-bold">Description</h4>
                        <p class="my-4">{{ props.model.listing.description }}</p>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 lg:mt-4">
                    <h4 class="text-2xl font-bold text-center text-blue-700">More Details</h4>
                    <div class="mt-6 flex flex-wrap ">
                        <div class="w-full p-2 sm:w-full">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <span class="font-medium">{{ props.model.listing.mobile }}</span>
                            </div>
                        </div>
                        <div class="w-full p-2 sm:w-full">
                            <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3 text-green-600">
                                    <path stroke-linecap="round" d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25" />
                                </svg>
                                <span class="font-medium">{{ props.model.listing.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GeneralLayout>
</template>
