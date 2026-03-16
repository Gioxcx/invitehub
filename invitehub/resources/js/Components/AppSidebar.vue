<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { getNavigation } from "@/Configs/navigation";

const page = usePage();

const isAdmin = computed(() => !!page.props.auth?.is_admin);
const navigation = computed(() => getNavigation(isAdmin.value));
</script>

<template>
    <aside
        class="hidden md:flex md:w-64 md:flex-col bg-white border-r border-gray-100"
    >
        <div class="h-16 flex items-center px-6 border-b border-gray-100">
            <Link :href="route('dashboard')" class="flex items-center gap-2">
                <ApplicationLogo
                    class="block h-8 w-auto fill-current text-gray-900"
                />
                <span class="font-semibold text-gray-900">InviteHub</span>
            </Link>
        </div>

        <nav class="p-3 space-y-1">
            <NavLink
                v-for="item in navigation"
                :key="item.route"
                :href="route(item.route)"
                :active="route().current(item.active)"
            >
                {{ item.label }}
            </NavLink>
        </nav>

        <div class="mt-auto p-4 border-t border-gray-100 text-xs text-gray-500">
            <div class="font-medium text-gray-700">
                {{ page.props.auth?.user?.name }}
            </div>
            <div class="truncate">{{ page.props.auth?.user?.email }}</div>
        </div>
    </aside>
</template>
