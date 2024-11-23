<script setup lang="ts">
import { h } from 'vue';
import LayoutDashboard from '@/components/LayoutDashboard.vue';
import TableTanstack from '@/components/ui/Table/TableTanstack.vue';
import ViewButton from '@/components/ui/Table/ViewButton.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const usersList = [
    {
        id: 1,
        name: 'John Doe',
        email: 'test@test.etst',
        role: 'Admin',
        status: 'Active',
    },
];

const columnsUsers = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'email',
        header: 'Email',
    },
    {
        accessorKey: 'role',
        header: 'Role',
    },
    {
        accessorKey: 'status',
        header: 'Status',
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }: { row: { original: { id: number } } }) =>
            h(
                'button',
                {
                    onClick: () => callMoveToUser(row.original.id),
                    class: 'text-purple-500 hover:underline',
                },
                'View',
            ),
        enableSorting: false,
    },
];

function callMoveToUser(id: number) {
    console.log('Move to user with ID:', id);
    router.push(`/admin/users/${id}`);
}
</script>

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

<template>
    <LayoutDashboard>
        <TableTanstack :columns="columnsUsers" :data="usersList" tableName="Users List">
            <template #actions="{ row }">
                <ViewButton :link="`/admin/users/${row.id}`" />
            </template>
        </TableTanstack>
    </LayoutDashboard>
</template>
