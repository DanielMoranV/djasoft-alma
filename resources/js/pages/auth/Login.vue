<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    dni: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase title="Alma - Gestor de Inventario -" description="Inicia sesión para continuar">
        <Head title="Iniciar sesión" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <!-- Campo DNI -->
                <div class="grid gap-2">
                    <Label for="dni">DNI</Label>
                    <Input
                        id="dni"
                        type="text"
                        required
                        minlength="8"
                        maxlength="8"
                        pattern="\d{8}"
                        autofocus
                        :tabindex="1"
                        autocomplete="username"
                        v-model="form.dni"
                        placeholder="Ingresa tu DNI (8 dígitos)"
                    />
                    <InputError :message="form.errors.dni" />
                </div>

                <!-- Campo Contraseña -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Contraseña</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5">
                            ¿Olvidaste tu contraseña?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Ingresa tu contraseña"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <!-- Recordar sesión -->
                <div class="flex items-center justify-between" :tabindex="3">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="4" />
                        <span>Recordarme</span>
                    </Label>
                </div>

                <!-- Botón de ingreso -->
                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Ingresar
                </Button>
            </div>

            <!-- Registro -->
            <div class="text-muted-foreground text-center text-sm">
                ¿No tienes una cuenta?
                <TextLink :href="route('register')" :tabindex="5">Regístrate</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
