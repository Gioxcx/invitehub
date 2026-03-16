<script setup>
import { ref, computed } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { getNavigation } from "@/Configs/navigation";

const showingNavigationDropdown = ref(false);
const page = usePage();

const isAdmin = computed(() => !!page.props.auth?.is_admin);
const navigation = computed(() => getNavigation(isAdmin.value));
</script>

<template>
    <nav class="border-b border-gray-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex shrink-0 items-center md:hidden">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-900"
                            />
                        </Link>
                    </div>

                    <div class="text-sm text-gray-500 hidden md:block">
                        <slot name="breadcrumb" />
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center">
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-600 transition hover:text-gray-900 focus:outline-none"
                                    >
                                        {{ page.props.auth.user.name }}
                                        <svg
                                            class="-me-0.5 ms-2 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"
                                    >Profile</DropdownLink
                                >
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    >Log Out</DropdownLink
                                >
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 focus:outline-none"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
        >
            <div class="space-y-1 pb-3 pt-2">
                <ResponsiveNavLink
                    v-for="item in navigation"
                    :key="item.route"
                    :href="route(item.route)"
                    :active="route().current(item.active)"
                >
                    {{ item.label }}
                </ResponsiveNavLink>
            </div>

            <div class="border-t border-gray-200 pb-1 pt-4">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">
                        {{ page.props.auth.user.name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">
                        {{ page.props.auth.user.email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :href="route('profile.edit')"
                        >Profile</ResponsiveNavLink
                    >
                    <ResponsiveNavLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                        >Log Out</ResponsiveNavLink
                    >
                </div>
            </div>
        </div>
    </nav>
</template>
