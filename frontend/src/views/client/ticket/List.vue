<script setup lang="ts">
import LayoutDashboard from '@/components/client/LayoutDashboard.vue';
import TableTanstack from '@/components/client/ui/Table/TableTanstack.vue';
import { h } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

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
];
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
        cell: ({ row }: { row: { original: { id: number } } }) =>
            h(
                'button',
                {
                    onClick: () => callMovetoTicket(row.original.id),
                    class: 'text-purple-500 hover:underline',
                },
                'View',
            ),
    },
];

function callMovetoTicket(id: number) {
    console.log('Move to ticket with ID:', id);
    router.push(`/ticket/${id}`);
}
</script>

<template>
    <LayoutDashboard>
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-100">Support Tickets</h1>
                <button
                    class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-sm font-medium transition-colors"
                >
                    New Ticket
                </button>
            </div>
            <TableTanstack :data="Tickets" :columns="columnsTickets" tableName="Your tickets" />
        </div>
    </LayoutDashboard>
</template>
