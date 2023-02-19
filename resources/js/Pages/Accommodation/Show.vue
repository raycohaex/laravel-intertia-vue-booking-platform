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
            {{ accommodation.name }}
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
        accommodation: Object
    }
}
</script>
