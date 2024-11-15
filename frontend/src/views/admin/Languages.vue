<template>
    <LayoutDashboard>
        <button @click="installLanguage" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Install Language</button>
        <TableTanstack :data="languages" :columns="columnsLanguages" tableName="Languages" />
    </LayoutDashboard>
</template>

<script setup>
import { ref } from 'vue'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import TableTanstack from '@/components/ui/Table/TableTanstack.vue'
import { h } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const languages = [
    {
        id: 1,
        name: 'English',
        author: 'John Doe',
    },
    {
        id: 2,
        name: 'Spanish',
        author: 'Jane Smith',
    },
    {
        id: 3,
        name: 'French',
        author: 'Pierre Dupont',
    },
];

const columnsLanguages = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'name',
        header: 'Name',
    },
    {
        accessorKey: 'author',
        header: 'Author',
    },
    {
        accessorKey: 'actions',
        header: 'Actions',
        cell: ({ row }) => h('button', {
            onClick: () => editLanguage(row.original.id),
            class: 'text-purple-500 hover:underline'
        }, 'Edit')
    },
];

function editLanguage(id) {
    console.log('Edit language with ID:', id);
    router.push(`/language/${id}/edit`);
}

function installLanguage() {
    console.log('Install language button clicked');
}

</script>
