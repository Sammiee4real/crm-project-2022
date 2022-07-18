<template>
    <Head title="Create Task" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">Edit A Project</div> <span><Link :href="route('projects.index')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">All Projects</Link></span>
            </h2>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-1 md:gap-6">
             
                <div class="mt-5 md:mt-0 md:col-span-1 md:mx-auto md:w-1/2">
                <form @submit.prevent="form.put(route('projects.update',project.id))">
                    <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="col-span-6 sm:col-span-3">
                               <BreezeValidationErrors class="mb-4" />
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                        
                        <div class="col-span-6 sm:col-span-6">
                               <BreezeLabel for="title" value="Title" />
                               <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
                               <!-- <div v-if="form.errors.contact_name">{{ form.errors.contact_name }}</div> -->
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                              <BreezeLabel for="description" value="Description" />
                               <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />  
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <BreezeLabel for="deadline" value="Deadline" />
                            <BreezeInput id="deadline" type="date" class="mt-1 block w-full" v-model="form.deadline" required autofocus autocomplete="deadline" />
                        </div>

                       <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="project_image" value="Upload File" />
                             <BreezeInput class="mt-1 block w-full" type="file" @input="form.project_image = $event.target.files[0]" />
                             <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                 {{ form.progress.percentage }}%
                             </progress>
                        </div>

                         <div class="col-span-6 sm:col-span-12">
                            <span>Current User: <strong>{{current_user.first_name}} {{current_user.last_name}}</strong> </span>
                            <BreezeLabel for="user_id"  value="Select User" />
                             <select required class="mt-1 block w-full"  v-model="form.user_id" id="user_id">
                                    <option v-for="user in users" :key="user.id">{{user.first_name}}-{{user.last_name}}</option>
                            </select>                
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <span>Current Client: <strong>{{current_client.contact_email}} - {{current_client.company_name}}</strong> </span>
                            <BreezeLabel for="client_id" value="Select Client" />
                             <select required class="mt-1 block w-full" v-model="form.client_id" id="client_id">
                                    <option v-for="client in clients" :key="client.id">{{client.contact_email}}</option>
                            </select>                
                        </div>


                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <!-- <button  type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Record</button> -->
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save Record
                        </BreezeButton>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

export default{
   
   props:{
        project: Object,
        users: Object,
        clients: Object,
        current_client: Object,
        current_user: Object,
   },
   components:{
        BreezeButton,
        BreezeInput, 
        BreezeLabel, 
        BreezeValidationErrors, 
        Link, 
        Head, 
        BreezeAuthenticatedLayout
   },
  setup(props){
        const form = useForm({
            title: props.project.title,
            description: props.project.description,
            deadline: props.project.deadline,
            //   status: props.project.status,
            client_id: props.project.client,
            user_id: props.project.user,
            project_image:null
       });
       
        return {form}  
        
   }

  
   
};
</script>


<!-- <script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    project: Object,
    users: Object,
    clients: Object,
    current_client: Object,
    current_user: Object,
});

const form = useForm({
      title: props.project.title,
      description: props.project.description,
      deadline: props.project.deadline,
      //   status: props.project.status,
      client_id: props.project.client,
      user_id: props.project.user
});
</script> -->

