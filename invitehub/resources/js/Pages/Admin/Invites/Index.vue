<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import Badge from "@/Components/Badge.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    roles: Array,
    invites: Array,
});

const page = usePage();
const flash = page.props.flash;

const form = useForm({
    email: "",
    role_name: props.roles?.[0] ?? "member",
});

function submit() {
    form.post(route("admin.invites.store"), {
        onSuccess: () => form.reset("email"),
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Usuários" />

        <PageHeader
            title="Usuários"
            subtitle="Envie convites e gerencie o acesso à plataforma."
        />

        <div
            v-if="flash?.success"
            class="mb-4 rounded-lg bg-green-50 border border-green-200 p-3 text-green-800"
        >
            {{ flash.success }}
        </div>
        <div
            v-if="flash?.error"
            class="mb-4 rounded-lg bg-red-50 border border-red-200 p-3 text-red-800"
        >
            {{ flash.error }}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Form -->
            <div class="lg:col-span-1 rounded-lg bg-white border p-4">
                <h2 class="font-medium text-gray-900 mb-3">
                    Convidar por e-mail
                </h2>

                <form @submit.prevent="submit" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >E-mail</label
                        >
                        <input
                            v-model="form.email"
                            class="mt-1 w-full rounded border-gray-300"
                            placeholder="email@exemplo.com"
                        />
                        <div
                            v-if="form.errors.email"
                            class="text-sm text-red-600 mt-1"
                        >
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Perfil</label
                        >
                        <select
                            v-model="form.role_name"
                            class="mt-1 w-full rounded border-gray-300"
                        >
                            <option v-for="r in roles" :key="r" :value="r">
                                {{ r }}
                            </option>
                        </select>
                        <div
                            v-if="form.errors.role_name"
                            class="text-sm text-red-600 mt-1"
                        >
                            {{ form.errors.role_name }}
                        </div>
                    </div>

                    <button
                        class="w-full inline-flex justify-center items-center rounded bg-black px-4 py-2 text-white"
                        :disabled="form.processing"
                    >
                        Enviar convite
                    </button>
                </form>
            </div>

            <!-- List -->
            <div
                class="lg:col-span-2 rounded-lg bg-white border overflow-hidden"
            >
                <div class="p-4 border-b">
                    <div class="font-medium text-gray-900">
                        Últimos convites
                    </div>
                    <div class="text-sm text-gray-600">
                        Histórico dos últimos envios
                    </div>
                </div>

                <div class="divide-y">
                    <div
                        v-for="inv in invites"
                        :key="inv.email + inv.created_at"
                        class="p-4 flex items-center justify-between gap-4"
                    >
                        <div class="min-w-0">
                            <div class="font-medium text-gray-900 truncate">
                                {{ inv.email }}
                            </div>
                            <div
                                class="mt-1 text-sm text-gray-600 flex items-center gap-2 flex-wrap"
                            >
                                <span>Role: {{ inv.role_name }}</span>
                                <span class="text-gray-300">•</span>
                                <Badge :value="inv.status" />
                            </div>
                        </div>

                        <div class="text-xs text-gray-500 whitespace-nowrap">
                            {{ inv.created_at }}
                        </div>
                    </div>

                    <div
                        v-if="!invites?.length"
                        class="p-6 text-sm text-gray-600"
                    >
                        Nenhum convite ainda.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
