<template>
  <LayoutDashboard>
    <button @click="installLanguage" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">
      Create a role
    </button>
    <TableTanstack :data="roles" :columns="columnsRoles" tableName="Languages" />
  </LayoutDashboard>
</template>

<script setup>
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import TableTanstack from '@/components/ui/Table/TableTanstack.vue'
import { h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const roles = [
  {
    id: 1,
    name: 'Admin',
    realname: 'Administrator',
    creationDate: '2021-01-01',
  },
  {
    id: 2,
    name: 'Editor',
    realname: 'Content Editor',
    creationDate: '2021-02-01',
  },
  {
    id: 3,
    name: 'Viewer',
    realname: 'Content Viewer',
    creationDate: '2021-03-01',
  },
]

const columnsRoles = [
  {
    accessorKey: 'id',
    header: 'ID',
  },
  {
    accessorKey: 'name',
    header: 'Name',
  },
  {
    accessorKey: 'realname',
    header: 'Real Name',
  },
  {
    accessorKey: 'creationDate',
    header: 'Creation Date',
  },
  {
    accessorKey: 'actions',
    header: 'Actions',
    cell: ({ row }) =>
      h(
        'button',
        {
          onClick: () => editRole(row.original.id),
          class: 'text-purple-500 hover:underline',
        },
        'Edit',
      ),
  },
]

function editRole(id) {
  console.log('Edit role with ID:', id)
  router.push(`/role/${id}/edit`)
}

function createRole() {
  console.log('Create role button clicked')
}
</script>
