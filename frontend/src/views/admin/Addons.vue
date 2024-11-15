<template>
    <LayoutDashboard>
        <button @click="installAddon" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Install Addon</button>
        <TableTanstack :data="addons" :columns="columnsAddons" tableName="Addons" />

    </LayoutDashboard>
</template>
<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import TableTanstack from '@/components/ui/Table/TableTanstack.vue'
import { h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const addons = [
    {
        id: 1,
        name: 'Addon One',
        stability: 'Stable',
        authors: 'Author One',
        enabled: true,
    },
    {
        id: 2,
        name: 'Addon Two',
        stability: 'Beta',
        authors: 'Author Two',
        enabled: false,
    },
    {
        id: 3,
        name: 'Addon Three',
        stability: 'Alpha',
        authors: 'Author Three',
        enabled: true,
    },
];

const columnsAddons = [
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'stability',
        header: 'Stability',
    },
    {
        accessorKey: 'authors',
        header: 'Authors',
    },
    {
        accessorKey: 'enabled',
        header: 'Enabled',
        cell: ({ row }) => row.original.enabled ? 'Yes' : 'No'
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }) => h('button', {
            onClick: () => callViewAddon(row.original.id),
            class: 'text-purple-500 hover:underline'
        }, 'View')
    },
];

function callViewAddon(id) {
    console.log('View addon with ID:', id);
    router.push(`/addon/${id}`);
}

function installAddon() {
    console.log('Install addon button clicked');
}

</script>