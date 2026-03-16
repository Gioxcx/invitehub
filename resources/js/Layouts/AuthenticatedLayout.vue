<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const page = usePage();

const isAdmin = computed(() => {
    return (
        Boolean(page.props.auth?.is_admin) ||
        (page.props.auth?.roles || []).includes("admin")
    );
});
</script>

<template>
    <aside
        class="hidden md:flex md:w-72 md:flex-col bg-white border-r border-slate-200"
    >
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <Link :href="route('dashboard')" class="flex items-center gap-3">
                <ApplicationLogo class="h-8 w-8 text-slate-900" />
                <div class="leading-tight">
                    <div class="font-semibold text-slate-900">InviteHub</div>
                    <div class="text-xs text-slate-500">Workspace</div>
                </div>
            </Link>
        </div>

        <nav class="p-3 space-y-1">
            <NavLink
                :href="route('dashboard')"
                :active="route().current('dashboard')"
            >
                Dashboard
            </NavLink>

            <NavLink
                v-if="isAdmin"
                :href="route('admin.invites.index')"
                :active="route().current('admin.invites.*')"
            >
                Usuários
            </NavLink>
        </nav>

        <div class="mt-auto border-t border-slate-200 p-4">
            <div class="text-sm font-medium text-slate-900">
                {{ page.props.auth.user.name }}
            </div>
            <div class="text-xs text-slate-500">
                {{ page.props.auth.user.email }}
            </div>
        </div>
    </aside>
</template>
