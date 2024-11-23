<script setup lang="ts">
import LayoutAccount from './Layout.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import ViewButton from '@/components/ui/Table/ViewButton.vue';
import { format } from 'date-fns';
import { h } from 'vue';

const emails = [
    {
        subject: 'Welcome to our service',
        sender: 'admin@example.com',
        created_at: '2023-10-01',
    },
    {
        subject: 'Your account has been updated',
        sender: 'support@example.com',
        created_at: '2023-10-02',
    },
    {
        subject: 'Password reset instructions',
        sender: 'no-reply@example.com',
        created_at: '2023-10-03',
    },
    {
        subject: 'New feature announcement',
        sender: 'news@example.com',
        created_at: '2023-10-04',
    },
];
const columnsEmails = [
    {
        accessorKey: 'subject',
        header: 'Subject',
    },
    {
        accessorKey: 'sender',
        header: 'Sender',
    },
    {
        accessorKey: 'created_at',
        header: 'Created',
        cell: (info: { getValue: () => string | number | Date }) => format(new Date(info.getValue()), 'MMM d, yyyy'),
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }: { row: { original: { id: string } } }) => h(ViewButton, { id: row.original.id }),
        enableSorting: false,
    },
];
</script>
<template>
    <!-- User Info -->
    <LayoutAccount />

    <div>
        <div class="overflow-x-auto">
            <TableTanstack :data="emails" :columns="columnsEmails" tableName="Emails" />
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
