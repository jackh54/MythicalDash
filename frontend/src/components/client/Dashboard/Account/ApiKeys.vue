<script setup lang="ts">
import LayoutAccount from './Layout.vue';
import TableTanstack from '@/components/client/ui/Table/TableTanstack.vue';
import { format } from 'date-fns';
const columnsApis = [
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'type',
        header: 'Type',
    },
    {
        accessorKey: 'value',
        header: 'Value',
    },
    {
        accessorKey: 'date',
        header: 'Date',
        cell: (info: { getValue: () => string | number | Date }) => format(new Date(info.getValue()), 'MMM d, yyyy'),
    },
];

const Apis = [
    {
        name: 'API Key 1',
        type: 'Read/Write',
        value: '1234567890',
        date: '2023-10-01',
    },
    {
        name: 'API Key 2',
        type: 'Read',
        value: '0987654321',
        date: '2023-10-02',
    },
    {
        name: 'API Key 3',
        type: 'Write',
        value: '1234567890',
        date: '2023-10-03',
    },
];
</script>

<template>
    <!-- User Info -->
    <LayoutAccount />

    <div>
        <div class="overflow-x-auto">
            <TableTanstack :data="Apis" :columns="columnsApis" tableName="Api Keys" />
        </div>
    </div>
</template>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.overflow-x-auto::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-x-auto {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}
</style>
