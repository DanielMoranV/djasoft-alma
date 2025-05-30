import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type NavGroup = {
    label: string; // Nombre del módulo: "Desarrollador", "Administrador", etc.
    items: NavItem[];
};
export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    password: string;
    dni: string;
    email: string;
    position: string;
    avatar?: string;
    is_active: boolean;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Company {
    id: number;
    name: string;
    email: string;
    phone: string;
    address: string;
    website: string;
    logo: string;
    description: string;
    users: User[];
}

export type BreadcrumbItemType = BreadcrumbItem;
