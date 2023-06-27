<script setup>
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    from: Number,
    to: Number,
    total: Number,
    current_page: Number,
    last_page: Number,
    first_page_url: String,
    prev_page_url: String,
    next_page_url: String,
    last_page_url: String,
})

</script>
<template>
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-end space-x-2 text-right mr-2.5">
            <a :href="prev_page_url" title="First page"
               class="rounded text-white text-sm p-1 bg-gray-900 hover:bg-gray-900 hover:shadow-lg focus:outline-none"
               :class="{'pointer-events-none bg-gray-300' : !prev_page_url}"
            >
                First
            </a><a :href="prev_page_url" title="Previous page"
                   class="rounded text-white text-sm p-1 bg-gray-900 hover:bg-gray-900 hover:shadow-lg focus:outline-none"
                   :class="{'pointer-events-none bg-gray-300' : !prev_page_url}"
        >
            Prev
        </a>
        </div>
        <div>
            <span v-if="props.total > 0">
                Showing {{ props.from }} - {{ props.to }} of {{ props.total }} results
            </span>
            <span v-else>
                Showing 0 results
            </span>
        </div>
        <div class="flex items-center justify-end space-x-2 text-right mr-2.5 ml-2.5">
            <a :href="next_page_url" title="Next page"
               class="rounded text-white text-sm p-1 bg-gray-900 hover:bg-gray-900 hover:shadow-lg focus:outline-none"
               :class="{'pointer-events-none bg-gray-300' : !next_page_url}"
            >
                Next
            </a><a :href="last_page_url" title="Last page"
                   class="rounded text-white text-sm p-1 bg-gray-900 hover:bg-gray-900 hover:shadow-lg focus:outline-none"
               :class="{'pointer-events-none bg-gray-300' : current_page == last_page}"
            >
                Last
            </a>
        </div>
    </div>
</template>
