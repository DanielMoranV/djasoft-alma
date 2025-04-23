<script lang="ts" setup>
import Button from '@/components/ui/button/Button.vue';
import DataTable from '@/components/ui/data-table/DataTable.vue';
import { Toaster } from '@/components/ui/sonner';
import { columns } from '@/components/ui/users/columns';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, SharedData, User } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { CirclePlus } from 'lucide-vue-next';
import { computed, provide, ref } from 'vue';
import { toast } from 'vue-sonner';

interface UserPageProps extends SharedData {
    users: User[];
}

const isDeleting = ref<number | null>(null);

const { props } = usePage<UserPageProps>();

const users = computed(() => props.users);

console.log(users.value);

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }];

const deleteUser = async (id: number) => {
    isDeleting.value = id;
    router.delete(`/users/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Usuario eliminado correctamente 🗑️', {
                description: 'Todos los datos del usuario fueron eliminados.',
                duration: 3000, // tiempo en milisegundos
                position: 'top-right', // top-left, top-center, bottom-right, etc.
            });
            isDeleting.value = null;
            router.visit('/users', { replace: true });
        },
        onError: () => {
            toast.error('Error al eliminar el usuario');
            isDeleting.value = null;
        },
    });
};

// Provee la función globalmente
provide('deleteUser', deleteUser);
provide('isDeleting', isDeleting);
</script>

<template>
    <Toaster />
    <Head title="Users" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-600 focus:ring-indigo-500">
                    <Link href="/users/create"> <CirclePlus class="h-5 w-5" /> Nuevo Usuario </Link>
                </Button>
            </div>
            <div class="relative min-h-[100vh] flex-1 md:min-h-min">
                <DataTable :columns="columns" :data="users" :caption="'Lista de Usuarios'" />
            </div>
        </div>
    </AppLayout>
</template>
