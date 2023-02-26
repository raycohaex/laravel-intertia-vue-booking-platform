<template>
    <AppLayout title="Accommodations">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <header class="py-2 flex justify-between">
                <!-- back button, route is 'accommodations.index' -->
            </header>
            <div class="flex flex-col py-4">
                <div class="flex items-center mb-3">
                    <Link :href="route('accommodation.show', { accommodation: accommodation.slug })" class="flex items-center space-x-1 mr-5">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </Link>
                    <h1 class="text-2xl font-bold">Book accommodation</h1>
                </div>
                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-3">
                        <stripe-checkout
                            ref="checkoutRef"
                            :pk="publishableKey"
                            :session-id="stripeSessionId"
                            />

                            <!-- fake checkout form with disabled inputs and prefilled fake data as placeholder -->
                            <div class="bg-slate-200 p-1 rounded w-full mb-2 text-sm">Hardcoded form information, deliberately left out. Click pay to continue</div>
                            <form class="opacity-50 mb-5">
                                <div class="flex flex-col space-y-4">
                                    <div class="flex flex-col space-y-2">
                                        <label for="name" class="text-sm">Name</label>
                                        <input type="text" id="name" name="name" class="border border-gray-200 p-2 rounded" disabled value="John Doe">
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                        <label for="email" class="text-sm">Email</label>
                                        <input type="email" id="email" name="email" class="border border-gray-200 p-2 rounded" disabled value="john.doe@example.com">
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                        <label for="address" class="text-sm">Address</label>
                                        <input type="text" id="address" name="address" class="border border-gray-200 p-2 rounded" disabled value="1234 Main St">
                                    </div>
                                    <div class="flex justify-between gap-3 items-center">
                                        <div class="flex flex-col space-y-2 w-full">
                                            <label for="city" class="text-sm">City</label>
                                            <input type="text" id="city" name="city" class="border border-gray-200 p-2 rounded" disabled value="New York">
                                        </div>
                                        <div class="flex flex-col space-y-2 w-full">
                                            <label for="state" class="text-sm">State</label>
                                            <input type="text" id="state" name="state" class="border border-gray-200 p-2 rounded" disabled value="NY">
                                        </div>
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                        <label for="zip" class="text-sm">Zip</label>
                                        <input type="text" id="zip" name="zip" class="border border-gray-200 p-2 rounded" disabled value="10001">
                                    </div>
                                </div>
                            </form>

                        <button type="button"
                                @click="submit"
                                class="bg-black text-white font-bold py-2 px-4 rounded">
                            Pay
                        </button>
                    </div>
                    <div class="col-span-2 border border-gray-200 p-4 shadow-md rounded-xl mb-auto">
                        <div class="flex border-b border-gray-200 py-3 pb-6">
                            <img :src="accommodation.images[0].url" class="w-[124px] h-[100px] rounded-lg mr-3">
                            <h2 class="text-sm">{{ accommodation.name }}</h2>
                        </div>
                        <AccommodationPrice :accommodationPrice="accommodationPrice"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import AccommodationPrice from '@/Components/AccommodationPrice.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { StripeCheckout } from '@vue-stripe/vue-stripe';

export default {
    components: {
        AppLayout,
        AccommodationPrice,
        StripeCheckout,
        Link
    },
    props: {
        accommodation: Object,
        accommodationPrice: Object,
        user: Object,
        stripeSessionId: String,
        publishableKey: String
    },
    methods: {
        submit() {
            this.$refs.checkoutRef.redirectToCheckout();
        }
    }
};
</script>
