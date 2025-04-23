<script setup lang="ts">
import { Edit, Loader2, Trash2 } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { router } from '@inertiajs/vue3'
import ConfirmDialog from '@/components/ConfirmDialog.vue'
import { Ref } from 'vue'
import { inject } from 'vue'
import { computed } from 'vue';

const deleteUser = inject<(id: number) => void>('deleteUser')
const isDeleting = inject<Ref<number | null>>('isDeleting');
const isUserDeleting = computed(() => isDeleting?.value === props.user.id);

const props = defineProps<{
  user: {
    id: number
    name: string
  }
}>()

const emit = defineEmits<{
  (e: 'delete', id: string): void
}>()

function handleEdit() {
  router.visit(`/users/${props.user.id}/edit`)
}
</script>

<template>
  <div class="flex items-center gap-2">
    <Button variant="outline" size="icon" @click="handleEdit">
      <Edit class="w-4 h-4" />
    </Button>

    <ConfirmDialog
      :title="`Eliminar a ${props.user.name}`"
      description="¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer."
      :onConfirm="() => deleteUser?.(props.user.id)"
    >
      <template #trigger>
        <Button
          variant="destructive"
          size="icon"
          :disabled="isUserDeleting"
        >
          <Loader2 v-if="isUserDeleting" class="w-4 h-4 animate-spin" />
          <Trash2 v-else class="w-4 h-4" />
        </Button>
      </template>
    </ConfirmDialog>
  </div>
</template>
