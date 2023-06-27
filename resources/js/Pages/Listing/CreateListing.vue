<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GeneralLayout from "@/Layouts/GeneralLayout.vue";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    }
})

const form = useForm({
    title: '',
    description: '',
    price: '',
    currency: '',
    date_online: '',
    date_offline: '',
    mobile: '',
    email: '',
    category_id: '',
});

const onFormSubmit = () => {
    form.post(route('listing.store'));
}
</script>
<template>
    <Head title="Create Listing"/>

    <GeneralLayout>
        <section class="p-8 text-center bg-gradient-to-r from-blue-200 to-purple-500 lg:p-20">
            <h1 class="mb-2 text-2xl font-bold text-gray-700 lg:text-5xl">
                Create Listing

            </h1>
            <div class="text-white">
                <span class="text-blue-800"><a :href="route('listing.index')">Home</a> / </span><span
                class="text-sm text-gray-100">Create</span>
            </div>
        </section>
        <section class="px-4 py-4 bg-gray-200 lg:px-20 lg:py-8 h-screen">
            <div class="space-y-4">
                <div class="p-4 text-gray-600 bg-white rounded-lg">
                    <form @submit.prevent="onFormSubmit" class="mt-6">
                        <div class="grid grid-cols-3 md:grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="title" value="Title"/>
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="block w-full"
                                    v-model="form.title"
                                    required
                                    autofocus
                                    autocomplete="title"
                                />
                                <InputError class="mt-2" :message="form.errors.title"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="price" value="Price"/>
                                <TextInput
                                    placeholder="0.00"
                                    id="price"
                                    type="text"
                                    class="block w-full"
                                    v-model="form.price"
                                    required
                                    autofocus
                                    autocomplete="price"
                                />
                                <InputError class="mt-2" :message="form.errors.price"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="currency" value="Currency"/>
                                <select
                                    v-model="form.currency"
                                    class="w-full p-2 bg-white border border-gray-400 rounded outline-none focus:ring-1">
                                    <option value="">----</option>
                                    <option :value="currency" v-for="(currency, index) in ['R', '$']" :key="index">
                                        {{ currency }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.currency"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="mobile" value="Mobile"/>
                                <TextInput
                                    id="mobile"
                                    type="text"
                                    class="block w-full"
                                    v-model="form.mobile"
                                    required
                                    autocomplete="mobile"
                                />
                                <InputError class="mt-2" :message="form.errors.mobile"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="email" value="E-mail"/>
                                <TextInput
                                    id="email"
                                    placeholder="test@test.com"
                                    type="email"
                                    class="block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                />
                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="date_online" value="Date Online"/>
                                <TextInput
                                    id="date_online"
                                    type="date"
                                    class="block w-full"
                                    v-model="form.date_online"
                                    required
                                    autocomplete="date_online"
                                />
                                <InputError class="mt-2" :message="form.errors.date_online"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="date_offline" value="Date Offline"/>
                                <TextInput
                                    id="date_offline"
                                    type="date"
                                    class="block w-full"
                                    v-model="form.date_offline"
                                    required
                                    autocomplete="date_offline"
                                />
                                <InputError class="mt-2" :message="form.errors.date_offline"/>
                            </div>
                            <div class="col-span-3 sm:col-span-1">
                                <InputLabel for="category" value="Category"/>
                                <select
                                    v-model="form.category_id"
                                    class="w-full p-2 bg-white border border-gray-400 rounded outline-none focus:ring-1">
                                    <option value="">----</option>
                                    <option :value="category.id" v-for="category in categories" :key="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_id"/>
                            </div>
                            <div class="col-span-3">
                                <InputLabel for="description" value="Description"/>
                                <textarea v-model="form.description" id="description" rows="4"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Your description..."></textarea>
                                <InputError class="mt-2" :message="form.errors.description"/>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <div>
                                <Link :href="route('listing.index')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-red-600 focus:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancel
                                </Link>
                            </div>
                            <div>
                                <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </GeneralLayout>
</template>
