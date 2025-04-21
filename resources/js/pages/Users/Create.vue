<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { AlertCircle, IdCard, Lock, Mail, User } from 'lucide-vue-next';
import { ref } from 'vue';

const form = ref({
    name: '',
    dni: '',
    email: '',
    password: '',
});

const errors = ref({
    name: '',
    dni: '',
    email: '',
    password: '',
});

const validateForm = () => {
    errors.value = {
        name: form.value.name ? '' : 'El nombre es obligatorio.',
        dni: /^\d{8}$/.test(form.value.dni) ? '' : 'El DNI debe tener 8 dígitos.',
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email) ? '' : 'El correo no es válido.',
        password: form.value.password.length >= 6 ? '' : 'La contraseña debe tener al menos 6 caracteres.',
    };

    return Object.values(errors.value).every((e) => !e);
};

const resetForm = () => {
    form.value = { name: '', dni: '', email: '', password: '' };
    errors.value = { name: '', dni: '', email: '', password: '' };
};

const submitForm = () => {
    if (validateForm()) {
        router.post('/users', form.value, { onSuccess: resetForm });
    }
};

const breadcrumbs = [
    { title: 'Usuarios', href: '/users' },
    { title: 'Crear', href: '#' },
];
</script>

<template>
    <Head title="Crear Usuario" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center justify-center gap-4 rounded-xl p-4">
            <div
                class="w-full max-w-md rounded-2xl border border-gray-200 bg-white/20 p-6 shadow-lg backdrop-blur-md transition-colors dark:border-gray-700 dark:bg-white/5"
            >
                <h1 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Crear Usuario</h1>

                <form @submit.prevent="submitForm" class="space-y-5">
                    <!-- Nombre -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <div class="relative">
                            <User class="absolute top-2.5 left-3 h-5 w-5 text-gray-400" />
                            <Input v-model="form.name" placeholder="Ej. Juan Pérez" class="pl-10" />
                        </div>
                        <p v-if="errors.name" class="mt-1 flex items-center gap-1 text-sm text-red-500">
                            <AlertCircle class="h-4 w-4" /> {{ errors.name }}
                        </p>
                    </div>

                    <!-- DNI -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">DNI</label>
                        <div class="relative">
                            <IdCard class="absolute top-2.5 left-3 h-5 w-5 text-gray-400" />
                            <Input v-model="form.dni" placeholder="Ej. 12345678" class="pl-10" />
                        </div>
                        <p v-if="errors.dni" class="mt-1 flex items-center gap-1 text-sm text-red-500">
                            <AlertCircle class="h-4 w-4" /> {{ errors.dni }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <div class="relative">
                            <Mail class="absolute top-2.5 left-3 h-5 w-5 text-gray-400" />
                            <Input v-model="form.email" type="email" placeholder="usuario@correo.com" class="pl-10" />
                        </div>
                        <p v-if="errors.email" class="mt-1 flex items-center gap-1 text-sm text-red-500">
                            <AlertCircle class="h-4 w-4" /> {{ errors.email }}
                        </p>
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                        <div class="relative">
                            <Lock class="absolute top-2.5 left-3 h-5 w-5 text-gray-400" />
                            <Input v-model="form.password" type="password" placeholder="********" class="pl-10" />
                        </div>
                        <p v-if="errors.password" class="mt-1 flex items-center gap-1 text-sm text-red-500">
                            <AlertCircle class="h-4 w-4" /> {{ errors.password }}
                        </p>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3">
                        <Button variant="outline" type="button" @click="resetForm">Cancelar</Button>
                        <Button type="submit">Guardar</Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
