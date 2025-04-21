<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, SharedData, User } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CirclePlus, Pencil, Trash } from 'lucide-vue-next';
import { computed } from 'vue';

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

const deleteUser = (id: number) => {
    console.log(id);
};
</script>
<template>
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
                            <TableCell>{{ user.is_active }}</TableCell>
                            <TableCell>{{ user.company ?? 'Sin empresa' }}</TableCell>
                            <TableCell>
                                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-600 focus:ring-indigo-500">
                                    <Link :href="'/users/${user.id}/edit'"> <Pencil class="h-5 w-5" /> </Link>
                                </Button>
                                <Button
                                    as-child
                                    size="sm"
                                    class="ml-2 bg-red-500 text-white hover:bg-red-600 focus:ring-red-500"
                                    @click="deleteUser(user.id)"
                                >
                                    <Link :href="'/users/${user.id}/delete'"> <Trash class="h-5 w-5" /> </Link>
                                </Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
