<template>
    <div v-if="accommodationPrice.days > 0" class="flex justify-between py-1 border-b border-gray-200">
        <span class="text-sm">{{ accommodationPrice.days }} nights X {{ price(accommodationPrice.basePrice) }}</span>
        <span class="mr-2">{{ price(accommodationPrice.days * accommodationPrice.basePrice) }}</span>
    </div>

    <div v-if="accommodationPrice.cleaning_cost > 0" class="flex justify-between py-1 border-b border-gray-200">
        <span class="text-sm">cleaning fee</span>
        <span class="mr-2">{{ price(accommodationPrice.cleaning_cost) }}</span>
    </div>
    <div v-if="accommodationPrice.fees > 0" class="flex justify-between py-1 border-b border-gray-200">
        <span class="text-sm">Service</span>
        <span class="mr-2">{{ price(accommodationPrice.fees) }}</span>
    </div>
    
    <div v-if="accommodationPrice.tax > 0" class="flex justify-between py-1 mb-2 border-b border-gray-500">
        <span class="text-sm">Tax (21%)</span>
        <span class="mr-2">{{ price(accommodationPrice.tax) }}</span>
    </div>

    <div v-if="accommodationPrice.totalPrice > 0" class="flex justify-between">
        <span class="text-sm font-medium">total</span>
        <span class="font-bold mr-2">{{ price(accommodationPrice.totalPrice) }}</span>
    </div>
</template>

<script>
export default {
    props: {
        accommodationPrice: {
            type: Object,
            required: true,
        },
    },
};
</script>
