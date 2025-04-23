<script lang="ts" setup>
import ConfirmDialog from '@/components/ConfirmDialog.vue';
import { Button } from '@/components/ui/button';
import { Toaster } from '@/components/ui/sonner';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, SharedData, User } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { CheckCircle, CirclePlus, Pencil, Trash, XCircle } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';

interface UserPageProps extends SharedData {
    users: User[];
}

const { props } = usePage<UserPageProps>();

const users = computed(() => props.users);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

const isDeleting = ref<number | null>(null);

const deleteUser = async (id: number) => {
    isDeleting.value = id;
    router.delete(`/users/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/users', { replace: true });
            toast.success('Usuario eliminado correctamente');
        },
        onError: (erros) => {
            toast.error('Error al eliminar el usuario');
            console.log(erros);
        },
    });
};
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
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <Table>
                    <TableCaption>Lista de Usuarios</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Nombre</TableHead>
                            <TableHead>DNI</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Activo</TableHead>
                            <TableHead>Empresa</TableHead>
                            <TableHead>Acciones</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in users" :key="user.id">
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.dni }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>
                                <div class="flex items-center gap-1">
                                    <CheckCircle v-if="user.is_active" class="h-4 w-4 text-green-500" />
                                    <XCircle v-else class="h-4 w-4 text-red-500" />
                                </div>
                            </TableCell>

                            <TableCell>{{ user.company ?? 'Sin empresa' }}</TableCell>
                            <TableCell>
                                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-600 focus:ring-indigo-500">
                                    <Link :href="`/users/${user.id}/edit`"> <Pencil class="h-5 w-5" /> </Link>
                                </Button>
                                <!-- Botón de Eliminar con confirmación -->
                                <ConfirmDialog
                                    :onConfirm="() => deleteUser(user.id)"
                                    :title="`Eliminar usuario: ${user.name}`"
                                    description="¿Estás seguro de que quieres eliminar este usuario? Esta acción no se puede deshacer."
                                >
                                    <template #trigger>
                                        <Button
                                            size="sm"
                                            class="ml-2 bg-red-500 text-white hover:bg-red-600 focus:ring-red-500"
                                            :disabled="isDeleting === user.id"
                                        >
                                            <Trash class="h-5 w-5" />
                                        </Button>
                                    </template>
                                </ConfirmDialog>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
