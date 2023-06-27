<script setup>
import {Head, router} from '@inertiajs/vue3';
import {ref} from "vue";
import GeneralLayout from "@/Layouts/GeneralLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    model: {
        type: Object,
        required: true,
    },
    filters: Object,
    categories: Array
})

const params = ref({
    per_page: props.filters.per_page ? props.filters.per_page : 15,
    title: props.filters.hasOwnProperty('filter') ? props.filters.filter.title : '',
    category: props.filters.hasOwnProperty('filter') ? props.filters.filter.category : '',
    sort_field: props.filters.hasOwnProperty('sort') ? props.filters.sort : 'price'
})

const searchListing = () => {
    router.get(route('listing.index'), {
        'filter[title]': params.value.title,
        'filter[category]': params.value.category,
        'per_page': params.value.per_page,
        'sort': params.value.sort_field
    }, {preserveState: true})
}

const clearFilter = () => {
    params.value.title = "";
    params.value.category = "";
    params.value.per_page = 15;
    params.value.sort_field = 'price';
    searchListing()
}

function truncateTitle(source, size = 10) {
    return source.length > size ? source.slice(0, size - 1) + "…" : source;
}

</script>
<template>
    <Head title="Listings"/>

    <GeneralLayout>
        <section class="p-8 text-center bg-gradient-to-r from-blue-200 to-purple-500 lg:p-20">
            <h1 class="mb-2 text-2xl font-bold text-gray-700 lg:text-5xl">
                Listings

            </h1>
            <div class="text-white">
                <span class="text-blue-800">Home</span>
            </div>
        </section>
        <!-- listing search section -->
        <div class="m-4 lg:m-0">
            <div class="p-8 bg-white lg:flex lg:items-center lg:justify-center">
                <form class="space-y-4 lg:space-y-0 lg:flex lg:space-x-4 lg:flex-nowrap">
                    <div class="">
                        <select
                            v-model="params.category"
                            class="w-[15rem] p-2 bg-white border border-gray-400 rounded outline-none focus:ring-2">
                            <option value="">----</option>
                            <option :value="category.name" v-for="category in categories" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <input type="text" v-model="params.title"
                               class="w-[35rem] p-2 border border-gray-400 rounded outline-none focus:ring-2"
                               Placeholder="title" />
                    </div>
                    <div>
                        <button @click="searchListing" type="button" class="px-8 py-2 text-blue-100 bg-gray-600 rounded">
                            Search</button>
                        <button @click="clearFilter" type="button" class="px-8 py-2 text-white bg-red-600 rounded ml-2.5">
                            Clear Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- All Property -->
        <section class="px-4 py-4 bg-gray-200 lg:px-20 lg:py-8">
            sort by: <div class="">
            <select
                v-model="params.sort_field"
                class="w-[15rem] p-2 bg-white border border-gray-400 rounded outline-none focus:ring-2">
                <option>----</option>
                <option :value="sort.value" v-for="(sort, index) in [{label:'Price Low', value:'price'}, {label:'Price High', value:'-price'}]" :key="index">
                    {{ sort.label }}
                </option>
            </select>
        </div>
            <div class="mt-4 space-y-2 lg:gap-4 lg:flex lg:items-center lg:flex-wrap lg:mt-20">
                <div v-for="listing in props.model.listings.data" class="p-4 bg-white rounded-lg">
                    <img src="https://images.unsplash.com/photo-1601760562234-9814eea6663a?ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cmVhbGVzdGF0ZXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                         alt="property">

                    <div class="p-6">
                        <h4 class="text-2xl font-bold cursor-pointer">{{ truncateTitle(listing.title, 35) }}</h4>
                        <div class="mt-2">
                            <span class="text-xl font-extrabold text-blue-600">R{{ listing.price }}</span>
                        </div>
                    </div>
                    <div class="p-4 text-gray-700 border-t border-gray-300">
                        <div class="flex items-center">
                            <p>Category: {{ listing.category.name }}</p>
                        </div>
                        <div class="flex items-center">
                            <p>3 mins ago</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container flex justify-center mx-auto mt-8">
                <Pagination
                    :from="props.model.listings.meta.from"
                    :to="props.model.listings.meta.to"
                    :total="props.model.listings.meta.total"
                    :current_page=props.model.listings.meta.current_page
                    :last_page=props.model.listings.meta.last_page
                    :next_page_url=props.model.listings.meta.next_page_url
                    :prev_page_url=props.model.listings.meta.prev_page_url
                    :first_page_url=props.model.listings.meta.first_page_url
                    :last_page_url=props.model.listings.meta.last_page_url
                />
            </div>
        </section>
    </GeneralLayout>
</template>
