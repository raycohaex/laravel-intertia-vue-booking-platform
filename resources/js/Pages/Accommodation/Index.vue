<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Accommodations">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Accommodations
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <h1>Accommodation List</h1>
                <ul>
                    <li v-for="accommodation in accommodations.data" :key="accommodation.id">
                        {{ accommodation.name }}
                    </li>
                </ul>
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
