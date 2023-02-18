<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <AppLayout title="Accommodations">
        <template #header>
            filters
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="grid grid-cols-5 gap-4">
                    <Link :href="route('accommodation.show', { accommodation: accommodation.id })" v-for="accommodation in accommodations.data" :key="accommodation.id" class="col-span-1">
                        <div class="w-full aspect-square bg-gray-100 rounded">
                            <img :src="accommodation.images[0].url" class="object-cover w-full h-full rounded" />
                        </div>
                        {{ accommodation.name }}
                    </Link>
                </div>
                <Pagination :links="accommodations.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'

export default {
    components: {
        Pagination
    },
    props: {
        confirmsTwoFactorAuthentication: Boolean,
        sessions: Array,
        accommodations: Object
    }
}
</script>
