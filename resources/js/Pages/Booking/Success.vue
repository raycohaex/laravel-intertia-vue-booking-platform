<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    booking: Object,
});
</script>

<template>
    <AppLayout title="Accommodations">
        <Head title="Success" />

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-7">
            <h1 class="text-xl font-bold w-full text-center mb-2">Successfully booked accommodation</h1>
            <div class="flex flex-col">
                <span>{{ booking.accommodation.name }}</span>
                <span>{{ booking.check_in }}</span>
                <span>{{ booking.check_out }}</span>
            </div>
        </div>
    </AppLayout>
</template>
