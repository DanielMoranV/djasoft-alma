import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue'
import type { Company } from '@/types';
import { CircleCheck, CircleX } from 'lucide-vue-next'
import Actions from '@/components/ui/users/Actions.vue'

export const columns: ColumnDef<Company>[] = [
  {
    accessorKey: 'name',
    header: 'Nombre',
  },
  {
    accessorKey: 'address',
    header: 'Dirección',
    },
  {
    accessorKey: 'email',
    header: 'Email',
    },
    {
      accessorKey:'phone',
      header: 'Teléfono',
    },
    {
        accessorKey: 'website',
        header: 'Web',
    },
  {
    accessorKey: 'logo',
    header: 'Logo',
    }, {
      accessorKey: 'description',
      header: 'Descripción',
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
