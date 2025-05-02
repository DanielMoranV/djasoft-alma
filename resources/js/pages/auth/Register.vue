<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    dni: '',
    email: '',
    password: '',
    password_confirmation: '',
    company_name: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="Crear una cuenta" description="Ingresa tus datos y registra tu negocio">
        <Head title="Registro" />
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <!-- Sección de Inputs -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Nombre de la empresa -->
                <div class="grid gap-2">
                    <Label for="company_name">Nombre de la empresa</Label>
                    <Input
                        id="company_name"
                        type="text"
                        required
                        autocomplete="organization"
                        v-model="form.company_name"
                        placeholder="Ej. Servicios Técnicos SAC"
                    />
                    <InputError :message="form.errors.company_name" />
                </div>

                <!-- Nombre completo -->
                <div class="grid gap-2">
                    <Label for="name">Nombre completo</Label>
                    <Input id="name" type="text" required autofocus autocomplete="name" v-model="form.name" placeholder="Ej. Juan Pérez" />
                    <InputError :message="form.errors.name" />
                </div>

                <!-- DNI -->
                <div class="grid gap-2">
                    <Label for="dni">DNI</Label>
                    <Input id="dni" type="text" required autocomplete="username" v-model="form.dni" placeholder="Ingresa tu DNI" />
                    <InputError :message="form.errors.dni" />
                </div>

                <!-- Email -->
                <div class="grid gap-2">
                    <Label for="email">Correo electrónico</Label>
                    <Input id="email" type="email" required autocomplete="email" v-model="form.email" placeholder="correo@ejemplo.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <!-- Contraseña -->
                <div class="grid gap-2">
                    <Label for="password">Contraseña</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Ingresa una contraseña"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <!-- Confirmar contraseña -->
                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirmar contraseña</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Repite la contraseña"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
            </div>

            <!-- Botón -->
            <Button type="submit" class="w-full" :disabled="form.processing">
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                Crear cuenta
            </Button>

            <!-- Link de inicio de sesión -->
            <div class="text-muted-foreground text-center text-sm">
                ¿Ya tienes una cuenta?
                <TextLink :href="route('login')" class="underline underline-offset-4">Inicia sesión</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
