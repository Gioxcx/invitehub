<script setup>
defineProps({
    title: { type: String, required: true },
    subtitle: { type: String, default: "" },
});
</script>

<template>
    <div class="mb-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    {{ title }}
                </h1>
                <p v-if="subtitle" class="mt-1 text-sm text-gray-600">
                    {{ subtitle }}
                </p>
            </div>

            <div class="shrink-0">
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>
