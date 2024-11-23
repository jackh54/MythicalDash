<script setup lang="ts">
import LayoutAccount from './Layout.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import { format } from 'date-fns';

const Activities = [
    {
        action: 'Login',
        description: 'User logged in',
        ip_address: '127.0.0.1',
        date: '2023-10-01',
    },
    {
        action: 'Logout',
        description: 'User logged out',
        ip_address: '127.0.0.1',
        date: '2023-10-01',
    },
    {
        action: 'Login',
        description: 'User logged in',
        ip_address: '127.0.0.1',
        date: '2023-10-01',
    },
];
const columnsActivities = [
    {
        accessorKey: 'action',
        header: 'Action',
    },
    {
        accessorKey: 'description',
        header: 'Description',
    },
    {
        accessorKey: 'ip_address',
        header: 'Ip Address',
    },
    {
        accessorKey: 'date',
        header: 'Created',
        cell: (info: { getValue: () => string | number | Date }) => format(new Date(info.getValue()), 'MMM d, yyyy'),
    },
];
</script>
<template>
    <!-- User Info -->
    <LayoutAccount />

    <div>
        <div class="overflow-x-auto">
            <TableTanstack :data="Activities" :columns="columnsActivities" tableName="Activities" />
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
