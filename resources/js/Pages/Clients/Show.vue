<template>
    <Head title="Clients" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">Clients</div> <span><Link :href="route('clients.create')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">Create Client</Link></span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                     <!-- v-for="link in clients.links" -->
                    <Pagination class="p-3 space-x-3" :links="clients.links" />

                    <ul v-for="client in clients.data" :key="client.id" class="p-4 bg-white border-b border-gray-200">
                         <li>ID: <strong>{{ client.id }}</strong> </li> 
                         <li>Contact Name: <strong>{{ client.contact_name }}</strong> </li> 
                         <li>Contact Email: {{ client.contact_email }} </li> 
                         <li>Company Address: {{ client.company_address }} </li> 
                         <li>Company City: {{ client.company_city }} </li> 
                         <li><strong>Projects</strong> </li> 
                        <li v-if="client.projects.length>0">{{client.projects.length}} Project(s):<br></li>
                        <li v-else>No Project<br></li>
                        <li v-for="project in client.projects"  :key="project.id" v-html="'-'+project.title"></li>
                        <li><Link as="button" :href="route('clients.edit')" class="text-blue-500">Edit</Link> &nbsp;| &nbsp; <Link as="button" href="#" class="text-red-500">Delete</Link></li>

                    </ul>
                    <!-- v-for="link in clients.links" -->
                    <Pagination class="p-3 space-x-3" :links="clients.links" />
                
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination  from '@/Components/Paginate.vue';
defineProps({
    clients: Object,
})
// export default{
//     components: {
//       Head,
//       BreezeAuthenticatedLayout,
//     },
//     props: {
//       client: Object,
//     },
// }
</script>
