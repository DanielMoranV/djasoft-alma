<script setup lang="ts" generic="TData, TValue">
import { ref } from 'vue'
import type { ColumnDef, ColumnFiltersState } from '@tanstack/vue-table'
import {
  useVueTable,
  getCoreRowModel,
  getPaginationRowModel,
  getFilteredRowModel,
  SortingState,
  VisibilityState,
  FlexRender,
} from '@tanstack/vue-table'

import { valueUpdater } from '../table/utils'

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
  TableCaption,
} from '@/components/ui/table'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { ChevronDown } from 'lucide-vue-next'

import {
  DropdownMenu,
  DropdownMenuCheckboxItem,
  DropdownMenuContent,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

import DataTablePagination from './DataTablePagination.vue'

const props = defineProps<{
  columns: ColumnDef<TData, TValue>[]
  data: TData[]
  caption?: string
}>()

const globalFilter = ref('')
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})

const table = useVueTable({
  get data() {
    return props.data
  },
  get columns() {
    return props.columns
  },
  getCoreRowModel: getCoreRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
  getFilteredRowModel: getFilteredRowModel(),
  onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
  onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
  state: {
    get globalFilter() {
      return globalFilter.value
    },
    get columnFilters() {
      return columnFilters.value
    },
    get columnVisibility() {
      return columnVisibility.value
    },
  },
})
</script>

<template>
  <div class="flex flex-wrap gap-2 py-4">
    <div class="flex items-center py-4 gap-2">
      <Input
        class="max-w-sm"
        placeholder="Buscar en todos los campos..."
        v-model="globalFilter"
      />

      <DropdownMenu>
        <DropdownMenuTrigger as-child>
          <Button variant="outline">
            Columnas
            <ChevronDown class="w-4 h-4 ml-2" />
          </Button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="end">
          <DropdownMenuCheckboxItem
            v-for="column in table.getAllColumns().filter(column => column.getCanHide())"
            :key="column.id"
            class="capitalize"
            :modelValue="column.getIsVisible()"
            @update:modelValue="value => column.toggleVisibility(!!value)"
          >
            {{ column.id }}
          </DropdownMenuCheckboxItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </div>
  </div>

  <div class="border rounded-md">
    <Table>
      <TableCaption>{{ props.caption ?? 'Lista de registros' }}</TableCaption>

      <TableHeader>
        <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
          <TableHead v-for="header in headerGroup.headers" :key="header.id">
            <FlexRender
              v-if="!header.isPlaceholder"
              :render="header.column.columnDef.header"
              :props="header.getContext()"
            />
          </TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        <template v-if="table.getRowModel().rows?.length">
          <TableRow
            v-for="row in table.getRowModel().rows"
            :key="row.id"
            :data-state="row.getIsSelected() ? 'selected' : undefined"
          >
            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
              <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
            </TableCell>
          </TableRow>
        </template>

        <template v-else>
          <TableRow>
            <TableCell :colspan="props.columns.length" class="h-24 text-center">
              No se encontraron resultados.
            </TableCell>
          </TableRow>
        </template>
      </TableBody>

      <DataTablePagination :table="table" />
    </Table>
  </div>
</template>
