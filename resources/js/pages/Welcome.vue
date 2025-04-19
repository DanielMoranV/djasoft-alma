<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Bienvenido">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="flex min-h-screen flex-col bg-white p-6 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
        <!-- HEADER CON BOTONES -->
        <header class="mx-auto mb-8 w-full max-w-7xl">
            <nav class="flex justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="rounded border border-gray-300 px-5 py-2 hover:border-gray-500 dark:border-gray-600 dark:hover:border-gray-400"
                >
                    Ir al Panel
                </Link>
                <template v-else>
                    <Link :href="route('login')" class="rounded border border-transparent px-5 py-2 hover:border-gray-400"> Iniciar sesión </Link>
                    <Link
                        :href="route('register')"
                        class="rounded border border-gray-300 px-5 py-2 hover:border-gray-500 dark:border-gray-600 dark:hover:border-gray-400"
                    >
                        Registrarse
                    </Link>
                </template>
            </nav>
        </header>

        <!-- CONTENIDO CENTRADO -->
        <main class="flex flex-1 flex-col items-center justify-center px-4 text-center">
            <h1 class="mb-4 text-4xl font-bold">Bienvenido a Alma App</h1>
            <p class="max-w-xl text-lg text-gray-600 dark:text-gray-300">
                Tu sistema de gestión integral para negocios modernos. Controla inventarios, ventas y más desde un solo lugar.
            </p>
        </main>
    </div>
</template>
