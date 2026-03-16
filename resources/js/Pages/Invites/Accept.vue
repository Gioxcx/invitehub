<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    invite: Object,
});

const form = useForm({
    name: "",
    password: "",
    password_confirmation: "",
});

function submit() {
    form.post(route("invites.accept", { token: props.invite.token }));
}
</script>

<template>
    <GuestLayout>
        <Head title="Aceitar convite" />

        <div class="max-w-lg mx-auto">
            <div class="rounded-lg bg-white border p-6 shadow-sm">
                <div class="mb-5">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Aceitar convite
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Você foi convidada(o) como
                        <strong>{{ invite.role_name }}</strong
                        >.
                    </p>
                    <p class="text-sm text-gray-600">
                        E-mail: <strong>{{ invite.email }}</strong>
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Nome</label
                        >
                        <input
                            v-model="form.name"
                            class="mt-1 block w-full rounded border-gray-300"
                        />
                        <div
                            v-if="form.errors.name"
                            class="text-sm text-red-600 mt-1"
                        >
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Senha</label
                        >
                        <input
                            type="password"
                            v-model="form.password"
                            class="mt-1 block w-full rounded border-gray-300"
                        />
                        <div
                            v-if="form.errors.password"
                            class="text-sm text-red-600 mt-1"
                        >
                            {{ form.errors.password }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Confirmar senha</label
                        >
                        <input
                            type="password"
                            v-model="form.password_confirmation"
                            class="mt-1 block w-full rounded border-gray-300"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex justify-center items-center rounded bg-black px-4 py-2 text-white"
                        :disabled="form.processing"
                    >
                        Criar conta
                    </button>
                </form>
            </div>

            <p class="mt-4 text-center text-xs text-gray-500">
                InviteHub • acesso por convite
            </p>
        </div>
    </GuestLayout>
</template>
