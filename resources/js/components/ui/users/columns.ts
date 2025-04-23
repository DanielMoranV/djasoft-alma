import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue'
import type { User } from '@/types';
import { CircleCheck, CircleX } from 'lucide-vue-next'
import Actions from '@/components/ui/users/Actions.vue'

export const columns: ColumnDef<User>[] = [
  {
    accessorKey: 'name',
    header: 'Nombre',
  },
  {
    accessorKey: 'dni',
    header: 'DNI',
  },
  {
    accessorKey: 'email',
    header: 'Email',
  },
  {
    accessorKey: 'is_active',
    header: 'Activo',
    cell: ({ getValue }) => {
      const isActive = getValue() as boolean
      return isActive
        ? h(CircleCheck, { class: 'w-4 h-4 text-green-600' })
        : h(CircleX, { class: 'w-4 h-4 text-red-600' })
    }
  },
  {
    accessorKey: 'company',
    header: 'Empresa',
  },
  {
    id: 'actions',
    enableHiding: false,
    cell: ({ row }) => {
      const user = row.original
      return h(Actions, {
        user,
        onDelete: (id: string) => {
          // Aquí puedes emitir un evento o manejarlo directamente
          console.log('Eliminando usuario con ID:', id)
        }
      })
    }
  }
]
