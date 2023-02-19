<template>
    <AppLayout title="Accommodations">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <header class="py-2 flex justify-between">
                <!-- back button, route is 'accommodations.index' -->
                <Link :href="route('accommodation.index')" class="flex items-center space-x-1 border border-gray-500 rounded-full p-2 text-sm hover:bg-gray-100 transition">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back</span>
                </Link>
            </header>
            <div class="flex flex-col py-4">
                <h1 class="font-bold text-[1.5rem]">{{ accommodation.name }}</h1>
                <!-- START Listing info -->
                <div class="flex flex-row items-center space-x-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                        <span class="underline">4,91 (131)</span>
                    </span>
                    <span class="relative flex items-center">
                        <span class="ml-3">{{ accommodation.host.name }}</span>
                        <span class="absolute left-0 w-[2px] h-[2px] bg-gray-600 rounded-full"></span>
                    </span>
                    <span class="relative flex items-center">
                        <span class="ml-3 flex items-center">
                            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span class="">{{ accommodation.city }}, {{ accommodation.country }}</span>
                        </span>
                        <span class="absolute left-0 w-[2px] h-[2px] bg-gray-600 rounded-full"></span>
                    </span>
                </div>
                <!-- END Listing info -->

                <!-- START image gallery -->
                <div class="my-6">
                    <div class="grid grid-rows-3 grid-cols-4 gap-2">
                        <div class="row-span-3 col-span-3 rounded-[20px] overflow-hidden">
                            <img :src="accommodation.images[0].url" alt="main image" class="w-full h-full object-cover">
                        </div>
                        <!-- foreach after array key 0, but no more than 3 iterations -->
                        <div class="row-span-1 col-span-1 rounded-[20px] overflow-hidden" v-for="image in accommodation.images.slice(1, 4)" :key="image.id">
                            <img :src="image.url" alt="extra image" class="w-full h-full object-cover">
                        </div>

                    </div>
                </div>
                <!-- END image gallery -->

                <!-- START listing info -->

                <!-- END listing info -->
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Pagination,
        AppLayout,
        Link
    },
    props: {
        confirmsTwoFactorAuthentication: Boolean,
        sessions: Array,
        accommodation: Object
    }
}
</script>
