<template>
  <LayoutDashboard>
    <TableTanstack :data="Tickets" :columns="columnsTickets" tableName="Tickets" />
  </LayoutDashboard>
</template>
<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import TableTanstack from '@/components/ui/Table/TableTanstack.vue'
import { h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const Tickets = [
  {
    id: 1,
    department: 'IT Support',
    subject: 'Computer not starting',
    status: 'Open',
    category: 'Hardware',
    created_at: '2023-10-01',
  },
  {
    id: 2,
    department: 'HR',
    subject: 'Payroll issue',
    status: 'In Progress',
    category: 'Payroll',
    created_at: '2023-10-01',
  },
  {
    id: 3,
    department: 'IT Support',
    subject: 'Email not working',
    status: 'Closed',
    category: 'Software',
    created_at: '2023-10-01',
  },
  {
    id: 4,
    department: 'Facilities',
    subject: 'Broken AC',
    status: 'Open',
    category: 'Maintenance',
    created_at: '2023-10-01',
  },
]
const columnsTickets = [
  {
    accessorKey: 'department',
    header: 'Department',
  },
  {
    accessorKey: 'subject',
    header: 'Subject',
  },
  {
    accessorKey: 'status',
    header: 'Status',
  },
  {
    accessorKey: 'category',
    header: 'Category',
  },
  {
    accessorKey: 'created_at',
    header: 'Created',
  },
  {
    accessorKey: 'actions',
    header: 'Actions',
    cell: ({ row }) =>
      h(
        'button',
        {
          onClick: () => callMovetoTicket(row.original.id),
          class: 'text-purple-500 hover:underline',
        },
        'View',
      ),
  },
]

function callMovetoTicket(id) {
  console.log('Move to ticket with ID:', id)
  router.push(`/ticket/${id}`)
}

const showNewTicketModal = ref(false)
const newTicket = ref({ subject: '', description: '' })

const openNewTicketModal = () => {
  showNewTicketModal.value = true
}

const createNewTicket = () => {
  // Here you would typically make an API call to create the ticket
  console.log('Creating new ticket:', newTicket.value)
  // For demonstration, let's add it to the list
  tickets.value.unshift({
    id: Math.max(...tickets.value.map((t) => t.id)) + 1,
    subject: newTicket.value.subject,
    status: 'Open',
    lastUpdated:
      new Date().toISOString().split('T')[0] +
      ' ' +
      new Date().toTimeString().split(' ')[0].slice(0, 5),
  })
  showNewTicketModal.value = false
  newTicket.value = { subject: '', description: '' }
}
</script>
