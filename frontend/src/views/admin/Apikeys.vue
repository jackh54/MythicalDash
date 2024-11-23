<template>
    <LayoutDashboard>
        <button @click="createApiKey" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Create API Key</button>
        <TableTanstack :data="apiKeys" :columns="columnsApiKeys" tableName="API Keys" />
    </LayoutDashboard>
</template>

<script setup lang="ts">
import LayoutDashboard from '@/components/LayoutDashboard.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import { h } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const apiKeys = [
    {
        id: 1,
        name: 'Key 1',
        key: 'abcd1234',
        date: '2023-10-01',
        permissions: 'Read, Write',
    },
    {
        id: 2,
        name: 'Key 2',
        key: 'efgh5678',
        date: '2023-10-02',
        permissions: 'Read',
    },
    {
        id: 3,
        name: 'Key 3',
        key: 'ijkl9101',
        date: '2023-10-03',
        permissions: 'Write',
    },
];

const columnsApiKeys = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'key',
        header: 'Key',
    },
    {
        accessorKey: 'date',
        header: 'Date Created',
    },
    {
        accessorKey: 'permissions',
        header: 'Permissions',
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }: { row: { original: { id: number } } }) =>
            h(
                'button',
                {
                    onClick: () => viewApiKey(row.original.id),
                    class: 'text-purple-500 hover:underline',
                },
                'View',
            ),
    },
];

function viewApiKey(id: number) {
    console.log('View API key with ID:', id);
    router.push(`/apikey/${id}`);
}

function createApiKey() {
    console.log('Create API key button clicked');
}
</script>
