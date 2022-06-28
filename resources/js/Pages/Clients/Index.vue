<template>
    <Head title="Clients" />
    
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">All Clients  &nbsp; <span class="text-sm">Total Record: {{total_clients}}</span> </div> <span><Link :href="route('clients.create')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">Create Client</Link></span>
            </h2>
        </template>

       <div class="w-full px-20">

	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<div class="p-4">
			<label for="table-search" class="sr-only">Search</label>

            
			<div class="relative mt-1">
				<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
					<svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
							clip-rule="evenodd"></path>
					</svg>
				</div>
				<input type="text" v-model="search" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for clients">
             </div>
			</div>
             <!-- v-for="link in clients.links" -->
            <Pagination class="p-3 mb-5 space-x-3" :links="clients.links" />
			<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
					<tr>
                        <!-- <th></th> -->

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                ID
                        </th>
                        <th class="px-6 py-4">
							Contact Name
						</th>
						<th class="px-6 py-4">
							Contact Email
						</th>
						<th class="px-6 py-4">
							Company Address
						</th>
						<th class="px-6 py-4">
							Company City
						</th>
                        <th class="px-6 py-4">
							Project(s)
						</th>
						<th class="px-6 py-4 text-right">
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="client in clients.data" :key="client.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
						<!-- <td class="w-4 p-4">
							<div class="flex items-center">
								<input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="checkbox-table-search-1" class="sr-only">checkbox</label>
							</div>
						</td> -->
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
							{{ client.id }}
						</th>
                        <td class="px-6 py-4">
							{{ client.contact_name }}
						</td>
						<td class="px-6 py-4">
							{{ client.contact_email }}
						</td>
						<td class="px-6 py-4">
							{{ client.company_address }}
						</td>
						<td class="px-6 py-4">
							{{ client.company_city }}
						</td>
                        <td class="px-6 py-4">
                            <!-- fix later -->
							
                            <span v-if="client.projects.length>0">{{client.projects.length}} Project(s):<br></span>
                            <span v-else>No Project<br></span>
                            <li v-for="project in client.projects"  :key="project.id" v-html="'-'+project.title"></li>
                            

                        </td>
						<td class="px-6 py-4 text-right flex items-center justify-center space-x-2">
						  <Link as="button" :href="route('clients.edit',client.id)" class="bg-blue-500 rounded px-2 text-white">Edit</Link>
						  <button @click="destroy(client.id)"  class="bg-red-500 rounded px-2 text-white">Delete</button>
						</td>
					</tr>
					
				
				</tbody>
			</table>
             <!-- v-for="link in clients.links" -->
            <Pagination class="p-3 mb-5 space-x-3" :links="clients.links" />
		</div>

		
	</div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia} from '@inertiajs/inertia';
import Pagination  from '@/Components/Paginate.vue';
import {ref, watch} from 'vue';
import debounce from 'lodash/debounce';
 

let props = defineProps({
    clients: Object,
	total_clients: String,
    filters: Object,
})

let search = ref(props.filters.search); 

watch(search, debounce(function(value){
        console.log('triggered');
        Inertia.get('/clients',{search:value}, {
        preserveState:true,
        replace:true
        })
},500))

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("clients.destroy", id));
    }
}

</script>

