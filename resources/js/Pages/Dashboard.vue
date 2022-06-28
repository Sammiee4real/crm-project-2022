<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                       Welcome {{$page.props.auth.user.first_name}}
                    </div>
                </div>
            </div>
                <div class="grid grid-cols-4 gap-2 mt-5 max-w-7xl mx-auto sm:px-6">
                    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Clients</h5>
                    <p class="text-gray-700 text-base mb-4">
                       Manage Clients
                    </p>
                    <Link :href="route('clients.index')" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click</Link>
                    </div>

                    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Projects</h5>
                    <p class="text-gray-700 text-base mb-4">
                         Manage Projects
                    </p>
                    <Link :href="route('projects.index')" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click</Link>
                    </div>

                    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Tasks</h5>
                    <p class="text-gray-700 text-base mb-4">
                        Manage Tasks
                    </p>
                    <Link :href="route('tasks.index')" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click</Link>
                   </div>


                    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Users</h5>
                    <p class="text-gray-700 text-base mb-4">
                        Manage Users
                    </p>
                    <Link :href="route('users.index')" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click</Link>
                    </div>

                </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
