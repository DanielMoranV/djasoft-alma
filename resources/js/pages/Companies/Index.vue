<script lang="ts" setup>
import Button from '@/components/ui/button/Button.vue';
import { columns } from '@/components/ui/companies/columns';
import DataTable from '@/components/ui/data-table/DataTable.vue';
import { Toaster } from '@/components/ui/sonner';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, Company, SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { CirclePlus } from 'lucide-vue-next';
import { computed } from 'vue';

interface CompanyPageProps extends SharedData {
    companies: Company[];
}

const { props } = usePage<CompanyPageProps>();

const companies = computed(() => props.companies);

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Companies', href: '/companies' }];
</script>

<template>
    <Toaster />
    <Head title="Companies" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-600 focus:ring-indigo-500">
                    <Link href="/companies/create"> <CirclePlus class="h-5 w-5" /> Nueva Empresa </Link>
                </Button>
            </div>
            <div class="relative min-h-[100vh] flex-1 md:min-h-min">
                <DataTable :columns="columns" :data="companies" :caption="'Lista de Empresas'" />
            </div>
        </div>
    </AppLayout>
</template>
