<script setup>
import { computed } from "vue";

const props = defineProps({
    value: { type: String, required: true },
});

const cls = computed(() => {
    const v = (props.value || "").toLowerCase();

    if (v === "accepted") return "bg-green-50 text-green-700 ring-green-200";
    if (v === "pending") return "bg-yellow-50 text-yellow-800 ring-yellow-200";
    if (v === "expired") return "bg-gray-100 text-gray-700 ring-gray-200";
    if (v === "cancelled" || v === "canceled")
        return "bg-red-50 text-red-700 ring-red-200";

    return "bg-gray-100 text-gray-700 ring-gray-200";
});
</script>

<template>
    <span
        class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset"
        :class="cls"
    >
        {{ value }}
    </span>
</template>
