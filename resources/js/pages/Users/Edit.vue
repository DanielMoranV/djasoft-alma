<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { User } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { AlertCircle, IdCard, Loader2, Mail, User as UserIcon } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { toast } from 'vue-sonner';

const isSubmitting = ref(false);
const { props } = usePage();
const user = props.user as User;
const form = ref({
    name: '',
    dni: '',
    email: '',
});

const errors = ref({
    name: '',
    dni: '',
    email: '',
});

onMounted(() => {
    form.value.name = user.name;
    form.value.dni = user.dni;
    form.value.email = user.email;
});

const validateForm = () => {
    errors.value = {
        name: form.value.name ? '' : 'El nombre es obligatorio.',
        dni: /^\d{8}$/.test(form.value.dni) ? '' : 'El DNI debe tener 8 dígitos.',
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email) ? '' : 'El correo no es válido.',
    };

    return Object.values(errors.value).every((e) => !e);
};

const resetForm = () => {
    form.value = { name: '', dni: '', email: '' };
    errors.value = { name: '', dni: '', email: '' };
};

const submitForm = () => {
    if (validateForm()) {
        isSubmitting.value = true;

        router.put(`/users/${user.id}`, form.value, {
            onSuccess: () => {
                toast.success('Usuario actualizado correctamente 🎉');
                resetForm();
                isSubmitting.value = false;
            },
            onError: () => {
                toast.error('Ocurrió un error al crear el usuario');
                isSubmitting.value = false;
            },
            onFinish: () => {
                isSubmitting.value = false;
            },
        });
    }
};

const breadcrumbs = [
    { title: 'Usuarios', href: '/users' },
    { title: 'Editar', href: '#' },
];
</script>

<template>
    <Head title="Editar Usuario" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center justify-center gap-4 rounded-xl p-4">
            <div
                class="w-full max-w-md rounded-2xl border border-gray-200 bg-white/20 p-6 shadow-lg backdrop-blur-md transition-colors dark:border-gray-700 dark:bg-white/5"
            >
                <h1 class="mb-2 text-xl font-bold text-gray-800 dark:text-white">Editar Usuario</h1>

                <!-- Formulario -->

                <form @submit.prevent="submitForm" class="space-y-5">
                    <!-- Nombre -->
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <div class="relative">
                            <UserIcon class="absolute top-2.5 left-3 h-5 w-5 text-gray-400" />
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

                    <!-- Botones -->
                    <div class="flex justify-end gap-3">
                        <Button variant="outline" type="button" @click="resetForm" :disabled="isSubmitting"> Cancelar </Button>
                        <Button type="submit" :disabled="isSubmitting" class="relative">
                            <Loader2 v-if="isSubmitting" class="absolute left-3 h-4 w-4 animate-spin" />
                            <span :class="{ 'opacity-0': isSubmitting }">Guardar</span>
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
