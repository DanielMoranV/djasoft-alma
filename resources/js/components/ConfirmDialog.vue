<script lang="ts" setup>
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { ref } from 'vue';

const props = defineProps<{
    title?: string;
    description?: string;
    onConfirm: () => void;
}>();

const open = ref(false);
</script>

<template>
    <AlertDialog v-model:open="open">
        <AlertDialogTrigger as-child>
            <slot name="trigger" />
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>{{ props.title ?? '¿Estás seguro?' }}</AlertDialogTitle>
                <AlertDialogDescription>{{ props.description ?? 'Esta acción no se puede deshacer.' }}</AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancelar</AlertDialogCancel>
                <AlertDialogAction @click="props.onConfirm">Confirmar</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
