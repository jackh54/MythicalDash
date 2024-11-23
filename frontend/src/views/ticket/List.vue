<template>
  <LayoutDashboard>
    <div class="space-y-6">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-100">Support Tickets</h1>
        <button
          @click="openNewTicketModal"
          class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-sm font-medium transition-colors"
        >
          New Ticket
        </button>
      </div>
      <TableTanstack :data="Tickets" :columns="columnsTickets" tableName="Your tickets" />
    </div>

    <!-- New Ticket Modal -->
    <Modal v-if="showNewTicketModal" @close="showNewTicketModal = false">
      <template #header>
        <h3 class="text-lg font-medium text-gray-100">Create New Ticket</h3>
      </template>
      <template #body>
        <form @submit.prevent="createNewTicket" class="space-y-4">
          <div>
            <label for="subject" class="block text-sm font-medium text-gray-400">Subject</label>
            <input
              type="text"
              id="subject"
              v-model="newTicket.subject"
              class="mt-1 block w-full bg-gray-800/50 border border-gray-700/50 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
              required
            />
          </div>
          <div>
            <label for="description" class="block text-sm font-medium text-gray-400"
              >Description</label
            >
            <textarea
              id="description"
              v-model="newTicket.description"
              rows="4"
              class="mt-1 block w-full bg-gray-800/50 border border-gray-700/50 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
              required
            ></textarea>
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-sm font-medium transition-colors"
            >
              Create Ticket
            </button>
          </div>
        </form>
      </template>
    </Modal>
  </LayoutDashboard>
</template>
<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import Modal from '@/components/ui/Modal.vue'
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
