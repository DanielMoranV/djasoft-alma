<script setup lang="ts" generic="T">
import { type Table } from '@tanstack/vue-table'

import { ChevronLeftIcon, ChevronRightIcon, SkipBackIcon, SkipForwardIcon } from 'lucide-vue-next'

import { Button } from '@/components/ui/button'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

defineProps<{
  table: Table<T>
}>()
</script>

<template>
  <div class="flex items-center justify-between px-2">
    <!-- Estado de selección -->
    <!-- <div class="flex-1 text-sm text-muted-foreground">
      {{ table.getFilteredSelectedRowModel().rows.length }} de
      {{ table.getFilteredRowModel().rows.length }} fila(s) seleccionada(s).
    </div> -->

    <!-- Controles de paginación -->
    <div class="flex items-center space-x-6 lg:space-x-8">

      <!-- Selección de filas por página -->
      <div class="flex items-center space-x-2">
        <p class="text-sm font-medium">Filas por página</p>
        <Select
          :model-value="`${table.getState().pagination.pageSize}`"
          @update:model-value="table.setPageSize"
        >
          <SelectTrigger class="h-8 w-[70px]">
            <SelectValue :placeholder="`${table.getState().pagination.pageSize}`" />
          </SelectTrigger>
          <SelectContent side="top">
            <SelectItem
              v-for="pageSize in [10, 20, 30, 40, 50]"
              :key="pageSize"
              :value="`${pageSize}`"
            >
              {{ pageSize }}
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <!-- Información de página actual -->
      <div class="flex w-[100px] items-center justify-center text-sm font-medium">
        Página {{ table.getState().pagination.pageIndex + 1 }} de
        {{ table.getPageCount() }}
      </div>

      <!-- Botones de navegación -->
      <div class="flex items-center space-x-2">
        <Button
          variant="outline"
          class="hidden w-8 h-8 p-0 lg:flex"
          :disabled="!table.getCanPreviousPage()"
          @click="table.setPageIndex(0)"
        >
          <span class="sr-only">Ir a la primera página</span>
          <SkipBackIcon class="w-4 h-4" />
        </Button>
        <Button
          variant="outline"
          class="w-8 h-8 p-0"
          :disabled="!table.getCanPreviousPage()"
          @click="table.previousPage()"
        >
          <span class="sr-only">Página anterior</span>
          <ChevronLeftIcon class="w-4 h-4" />
        </Button>
        <Button
          variant="outline"
          class="w-8 h-8 p-0"
          :disabled="!table.getCanNextPage()"
          @click="table.nextPage()"
        >
          <span class="sr-only">Página siguiente</span>
          <ChevronRightIcon class="w-4 h-4" />
        </Button>
        <Button
          variant="outline"
          class="hidden w-8 h-8 p-0 lg:flex"
          :disabled="!table.getCanNextPage()"
          @click="table.setPageIndex(table.getPageCount() - 1)"
        >
          <span class="sr-only">Ir a la última página</span>
          <SkipForwardIcon class="w-4 h-4" />
        </Button>
      </div>
    </div>
  </div>
</template>
