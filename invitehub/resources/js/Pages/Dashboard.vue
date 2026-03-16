<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <PageHeader title="Dashboard" subtitle="Visão geral do InviteHub" />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="rounded-lg bg-white border p-4">
                <div class="text-sm text-gray-500">Usuário</div>
                <div class="mt-1 font-semibold text-gray-900">
                    {{ page.props.auth.user.name }}
                </div>
            </div>

            <div class="rounded-lg bg-white border p-4">
                <div class="text-sm text-gray-500">E-mail</div>
                <div class="mt-1 font-semibold text-gray-900">
                    {{ page.props.auth.user.email }}
                </div>
            </div>

            <div class="rounded-lg bg-white border p-4">
                <div class="text-sm text-gray-500">Acesso</div>
                <div class="mt-2 flex gap-2 flex-wrap">
                    <span
                        v-for="r in page.props.auth.roles ?? []"
                        :key="r"
                        class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-700"
                    >
                        {{ r }}
                    </span>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
