<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    bookings: Object,
});
</script>

<template>
    <AppLayout title="Accommodations">
        <Head title="Success" />

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-7">
            <div class="flex flex-col">
                <span>{{ bookings.name }}</span>
                <span>{{ bookings.check_in }}</span>
                <span>{{ bookings.check_out }}</span>
            </div>
        </div>
    </AppLayout>
</template>
