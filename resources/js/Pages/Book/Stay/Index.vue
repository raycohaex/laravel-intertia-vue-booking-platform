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
                        <button type="button" @click="submit">Checkout</button>
                    </div>
                    <div class="col-span-2 border border-gray-200 p-4 shadow-md rounded-xl">
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
        StripeCheckout
    },
    data() {
        return {
            publishableKey: 'pk_test_51MfM66AVsCOL8hvw5pRPJLnwlVZ5K5J9nh583jDycUX7HNLQvfQJaof4uBGKCrKnWouIctJrqmz0ER0RoIHe1vng00VF8CiyIq'
            
        };
    },
    props: {
        accommodation: Object,
        accommodationPrice: Object,
        user: Object,
        stripeSessionId: String
    },
    methods: {
        submit() {
            this.$refs.checkoutRef.redirectToCheckout();
        }
    }
};
</script>
