<template>
  <LayoutDashboard>
    <div class="flex justify-begging mb-4">
      <button @click="createAnnouncement" class="bg-blue-500 text-white px-4 py-2 rounded">
        Create New Announcement
      </button>
    </div>
    <TableTanstack
      :data="Announcements"
      :columns="columnsAnnouncements"
      tableName="Announcements"
    />
  </LayoutDashboard>
</template>
<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import TableTanstack from '@/components/ui/Table/TableTanstack.vue'
import { h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const Announcements = [
  {
    id: 1,
    name: 'System Maintenance',
    date: '2023-10-01',
    postedBy: 'Admin',
    tags: ['Maintenance', 'System'],
  },
  {
    id: 2,
    name: 'New HR Policies',
    date: '2023-10-02',
    postedBy: 'HR Department',
    tags: ['HR', 'Policies'],
  },
  {
    id: 3,
    name: 'Office Renovation',
    date: '2023-10-03',
    postedBy: 'Facilities',
    tags: ['Renovation', 'Office'],
  },
  {
    id: 4,
    name: 'Software Update',
    date: '2023-10-04',
    postedBy: 'IT Support',
    tags: ['Software', 'Update'],
  },
]

const columnsAnnouncements = [
  {
    accessorKey: 'name',
    header: 'Name',
  },
  {
    accessorKey: 'date',
    header: 'Date',
  },
  {
    accessorKey: 'postedBy',
    header: 'Posted By',
  },
  {
    accessorKey: 'tags',
    header: 'Tags',
    cell: ({ row }) => row.original.tags.join(', '),
  },
  {
    accessorKey: 'actions',
    header: 'Actions',
    cell: ({ row }) =>
      h(
        'button',
        {
          onClick: () => callViewAnnouncement(row.original.id),
          class: 'text-purple-500 hover:underline',
        },
        'View',
      ),
  },
]

function callViewAnnouncement(id) {
  console.log('View announcement with ID:', id)
  router.push(`/announcement/${id}`)
}
</script>
