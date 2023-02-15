<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
    accommodations: Object
});
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
                <inertia-link v-if="accommodations.prev_page_url" :href="accommodations.prev_page_url">
                    Previous
                </inertia-link>
                <inertia-link v-if="accommodations.next_page_url" :href="accommodations.next_page_url">
                    Next
                </inertia-link>
            </div>
        </div>
    </AppLayout>
</template>
