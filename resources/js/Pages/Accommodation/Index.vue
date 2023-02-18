<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Accommodations">
        <template #header>
            filters
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="grid grid-cols-5 gap-4 gap-y-6">
                    <Link
                    :href="route('accommodation.show', { accommodation: accommodation.id })"
                    v-for="accommodation in accommodations.data"
                    :key="accommodation.id"
                    class="col-span-1 flex flex-col">
                        <div class="w-full aspect-square bg-gray-100 rounded-[20px] mb-1 overflow-hidden">
                            <img :src="accommodation.images[0].url" class="object-cover w-full h-full" />
                        </div>
                        <span class="font-bold">{{ accommodation.display_location }}</span>
                        <div><span class="font-medium text-md">€ {{accommodation.price}}</span><span> Night</span></div>
                    </Link>
                </div>
                <Pagination :links="accommodations.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Pagination,
        Link
    },
    props: {
        confirmsTwoFactorAuthentication: Boolean,
        sessions: Array,
        accommodations: Object
    }
}
</script>
