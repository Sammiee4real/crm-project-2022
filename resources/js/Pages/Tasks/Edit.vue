<template>
    <Head title="Edit Task" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">Edit Task: {{task.title}}</div> <span><Link :href="route('tasks.index')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">All Tasks</Link></span>
            </h2>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-1 md:gap-6">
             
                <div class="mt-5 md:mt-0 md:col-span-1 md:mx-auto md:w-1/2">
                <form @submit.prevent="form.put(route('tasks.update',task.id))">
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

                        <div class="col-span-6 sm:col-span-6">
                              <BreezeLabel for="description" value="Description" />
                               <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />  
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <BreezeLabel for="deadline" value="Deadline" />
                            <BreezeInput id="deadline" type="date" class="mt-1 block w-full" v-model="form.deadline" required autofocus autocomplete="deadline" />
                        </div>

                         <div class="col-span-6 sm:col-span-12">
                            <span>Current Project: <strong>{{current_project.title}}</strong> </span>
                            <BreezeLabel for="project" value="Change Project" />
                            <select required class="mt-1 block w-full" v-model="form.project_id" id="project_id">
                                    <option selected  value="{{current_project.id}}">{{current_project.title}}</option>
                                    <option v-for="project in projects" :key="project.id">{{project.title}}</option>
                            </select>
                        </div>

                         <!-- <div class="col-span-6 sm:col-span-3"> 
                           <BreezeLabel for="status" value="Status" />
                            <select class="mt-1 block w-full" v-model="form.status" id="status">  
                                <option v-for="status in task_statuses" :key="status.id" v-text="status.title"></option>
                            </select>
                        </div> -->
                
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <!-- <button  type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Record</button> -->
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Edit Record
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
     task: Object,
     projects: Object,
     current_project: Object
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
        title: props.task.title,
        description: props.task.description,
        deadline: props.task.deadline,
        // status:props.task.status,
        project_id: props.task.project
       });
       
        return {form}  
        
   }

  
   
};
</script>
