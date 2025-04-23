<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { NavGroup } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Building2, LayoutGrid, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavGroups: NavGroup[] = [
    {
        label: 'Desarrollador',
        items: [
            { title: 'Dashboard', href: '/dashboard', icon: LayoutGrid },
            { title: 'Usuarios', href: '/users', icon: Users },
            { title: 'Empresas', href: '/companies', icon: Building2 },
        ],
    },
    {
        label: 'Administrador',
        items: [
            { title: 'Empleados', href: '/employees', icon: Users },
            { title: 'Productos', href: '/products', icon: LayoutGrid },
            { title: 'Almacenes', href: '/warehouses', icon: Building2 },
        ],
    },
    {
        label: 'Ventas',
        items: [
            { title: 'Clientes', href: '/clients', icon: Users },
            { title: 'Cotizaciones', href: '/quotations', icon: LayoutGrid },
            { title: 'Facturas', href: '/invoices', icon: Building2 },
        ],
    },
];

// const footerNavItems: NavItem[] = [
//     {
//         title: 'Github Repo',
//         href: 'https://github.com/laravel/vue-starter-kit',
//         icon: Folder,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits',
//         icon: BookOpen,
//     },
// ];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :groups="mainNavGroups" />
        </SidebarContent>

        <SidebarFooter>
            <!-- <NavFooter :items="footerNavItems" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
