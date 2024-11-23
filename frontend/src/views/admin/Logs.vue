<script setup lang="ts">
import LayoutDashboard from '@/components/LayoutDashboard.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import { h } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const logs = [
    {
        id: 1,
        type: 'Error',
        created_at: '2023-10-01',
    },
    {
        id: 2,
        type: 'Error',
        created_at: '2023-10-01',
    },
    {
        id: 3,
        type: 'Error',
        created_at: '2023-10-01',
    },
    {
        id: 4,
        type: 'Error',
        created_at: '2023-10-01',
    },
];

const columnsLogs = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'type',
        header: 'Type',
    },
    {
        accessorKey: 'created_at',
        header: 'Date',
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }: { row: { original: { id: number } } }) =>
            h(
                'button',
                {
                    onClick: () => callMovetoLog(row.original.id),
                    class: 'text-purple-500 hover:underline',
                },
                'Download',
            ),
    },
];

function callMovetoLog(id: number) {
    console.log('Move to log with ID:', id);
    router.push(`/log/${id}`);
}
</script>
<template>
    <LayoutDashboard>
        <TableTanstack :data="logs" :columns="columnsLogs" tableName="Logs" />
    </LayoutDashboard>
</template>
