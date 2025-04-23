<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavGroup, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronDown } from 'lucide-vue-next';

defineProps<{
    groups: NavGroup[];
}>();

const page = usePage<SharedData>();
</script>

<template>
    <div>
        <Collapsible v-for="group in groups" :key="group.label" defaultOpen class="group/collapsible">
            <SidebarGroup class="px-2 py-0">
                <SidebarGroupLabel asChild>
                    <CollapsibleTrigger>
                        {{ group.label }}
                        <ChevronDown class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-180" />
                    </CollapsibleTrigger>
                </SidebarGroupLabel>
                <CollapsibleContent>
                    <SidebarMenu>
                        <SidebarMenuItem v-for="item in group.items" :key="item.title">
                            <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title">
                                <Link :href="item.href">
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </CollapsibleContent>
            </SidebarGroup>
        </Collapsible>
    </div>
</template>
