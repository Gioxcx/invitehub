<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  invite: Object,
})

const form = useForm({
  name: '',
  password: '',
  password_confirmation: '',
})

function submit() {
  form.post(route('invites.accept', { token: props.invite.token }))
}
</script>

<template>
  <GuestLayout>
    <Head title="Accept invite" />

    <div class="mb-6">
      <h1 class="text-2xl font-semibold">Accept your invite</h1>
      <p class="text-sm text-gray-600">
        You were invited as <strong>{{ invite.role_name }}</strong> to access InviteHub.
      </p>
      <p class="text-sm text-gray-600">
        Email: <strong>{{ invite.email }}</strong>
      </p>
    </div>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Name</label>
        <input v-model="form.name" class="mt-1 block w-full rounded border-gray-300" />
        <div v-if="form.errors.name" class="text-sm text-red-600">{{ form.errors.name }}</div>
      </div>

      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" v-model="form.password" class="mt-1 block w-full rounded border-gray-300" />
        <div v-if="form.errors.password" class="text-sm text-red-600">{{ form.errors.password }}</div>
      </div>

      <div>
        <label class="block text-sm font-medium">Confirm password</label>
        <input type="password" v-model="form.password_confirmation" class="mt-1 block w-full rounded border-gray-300" />
      </div>

      <button
        type="submit"
        class="inline-flex items-center rounded bg-black px-4 py-2 text-white"
        :disabled="form.processing"
      >
        Create account
      </button>
    </form>
  </GuestLayout>
</template>
