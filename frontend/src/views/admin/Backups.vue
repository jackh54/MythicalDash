<template>
    <LayoutDashboard>
        <button @click="createBackup" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Create Backup</button>
        <TableTanstack :data="backups" :columns="columnsBackups" tableName="Backups" />
    </LayoutDashboard>
</template>

<script setup lang="ts">
import LayoutDashboard from '@/components/LayoutDashboard.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import { h } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const backups = [
    {
        id: 1,
        status: 'Completed',
        date: '2023-10-01',
    },
    {
        id: 2,
        status: 'In Progress',
        date: '2023-10-02',
    },
    {
        id: 3,
        status: 'Failed',
        date: '2023-10-03',
    },
];

const columnsBackups = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'status',
        header: 'Status',
    },
    {
        accessorKey: 'date',
        header: 'Date',
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }: { row: { original: { id: number } } }) =>
            h(
                'button',
                {
                    onClick: () => viewBackup(row.original.id),
                    class: 'text-purple-500 hover:underline',
                },
                'View',
            ),
    },
];

function viewBackup(id: number) {
    console.log('View backup with ID:', id);
    router.push(`/backup/${id}`);
}

function createBackup() {
    console.log('Create backup button clicked');
}
</script>
