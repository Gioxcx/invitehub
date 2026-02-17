<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'

const props = defineProps({
  roles: Array,
  invites: Array,
})

const flash = usePage().props.flash

const form = useForm({
  email: '',
  role_name: props.roles?.[0] ?? 'member',
})

function submit() {
  form.post(route('admin.invites.store'), {
    onSuccess: () => form.reset('email'),
  })
}
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Usuários" />

    <div class="max-w-4xl">
      <h1 class="text-2xl font-semibold mb-4">Usuários</h1>

      <div v-if="flash?.success" class="mb-4 rounded bg-green-50 border border-green-200 p-3 text-green-800">
        {{ flash.success }}
      </div>

      <div class="rounded bg-white border p-4 mb-6">
        <h2 class="font-medium mb-3">Convidar por e-mail</h2>

        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <div class="md:col-span-2">
            <label class="block text-sm font-medium">E-mail</label>
            <input v-model="form.email" class="mt-1 w-full rounded border-gray-300" placeholder="email@exemplo.com" />
            <div v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</div>
          </div>

          <div>
            <label class="block text-sm font-medium">Perfil</label>
            <select v-model="form.role_name" class="mt-1 w-full rounded border-gray-300">
              <option v-for="r in roles" :key="r" :value="r">{{ r }}</option>
            </select>
            <div v-if="form.errors.role_name" class="text-sm text-red-600 mt-1">{{ form.errors.role_name }}</div>
          </div>

          <div class="md:col-span-3">
            <button class="inline-flex items-center rounded bg-black px-4 py-2 text-white" :disabled="form.processing">
              Enviar convite
            </button>
          </div>
        </form>
      </div>

      <div class="rounded bg-white border">
        <div class="p-4 border-b font-medium">Últimos convites</div>
        <div class="divide-y">
          <div v-for="inv in invites" :key="inv.email + inv.created_at" class="p-4 flex items-center justify-between">
            <div>
              <div class="font-medium">{{ inv.email }}</div>
              <div class="text-sm text-gray-600">Role: {{ inv.role_name }} • Status: {{ inv.status }}</div>
            </div>
            <div class="text-sm text-gray-500">
              {{ inv.created_at }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
