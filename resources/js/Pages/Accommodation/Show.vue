<template>
    <AppLayout title="Accommodations">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
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
                <h1 class="font-bold text-[1.5rem] max-w-[40ch]">{{ accommodation.name }}</h1>
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
                <div class="mt-6 mb-10">
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
                <div class="grid grid-cols-3">
                    <div class="col-span-2">
                        test
                    </div>
                    <div class="col-span-1">
                        <div class="rounded-[20px] shadow-lg border border-gray-200 p-4">

                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-bold text-xl mr-2">{{ accommodation.price }} €</span>
                                    <span class="text-sm">night</span>
                                </div>
                                <div>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                        <span class="underline">4,91 (131)</span>
                                    </span>
                                </div>
                            </div>

                            <div class="mt-2">
                                <date-picker
                                v-model:value="time"
                                range
                                format="DD-MM-Y"
                                :disabledDate="disableDate"
                                :onChange="calculatePrice"
                                style="width:100%;"/>
                            </div>

                            <div class="mt-2">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-bold text-xl mr-2">{{ price }} €</span>
                                        <span class="text-sm">total</span>
                                    </div>
                                    <div>
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                            Book
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- END listing info -->
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';

export default {
    components: {
        Pagination,
        AppLayout,
        Link,
        DatePicker
    },
    props: {
        confirmsTwoFactorAuthentication: Boolean,
        sessions: Array,
        accommodation: Object
    },
    data() {
        return {
            // select 1 week from now, range of 2 weeks, format like 2023-02-07 ~ 2023-03-15
            time: [new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000), new Date(new Date().getTime() + 14 * 24 * 60 * 60 * 1000)],
            price: 0
        }
    },
    methods: {
        eightMonthsFromToday() {
            const today = new Date()
            const eightMonths = 9 * 30 * 24 * 60 * 60 * 1000 // 8 months in milliseconds
            return new Date(today.getTime() + eightMonths)
        },
        disableDate(date) {
            return date < new Date() || date > this.eightMonthsFromToday()
        },
        calculatePrice() {
            axios.get(route('accommodations.price', [this.accommodation.id]), {
                params: {
                    start_date: this.time[0].toISOString().split('T')[0],
                    end_date: this.time[1].toISOString().split('T')[0]
                }
            }).then(response => {
                // round off price to 2 decimal places but if it's 1 cent add 0 in front
                this.price = response.data.price.toFixed(2).replace(/\.?0+$/, '')
            })
        }
    }
}
</script>
