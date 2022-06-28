<template>
    <Head title="Users" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">Edit User: {{user.first_name}} {{user.last_name}}</div> <span><Link :href="route('users.index')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">All Users</Link></span>
            </h2>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-1 md:gap-6">
             
                <div class="mt-5 md:mt-0 md:col-span-1 md:mx-auto md:w-1/2">
                <form @submit.prevent="form.put(route('users.update',user.id))">
                    <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="col-span-6 sm:col-span-3">
                               <BreezeValidationErrors class="mb-4" />
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                        
                        <div class="col-span-6 sm:col-span-3">
                               <BreezeLabel for="first_name" value="First Name" />
                               <BreezeInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
                               <!-- <div v-if="form.errors.contact_name">{{ form.errors.contact_name }}</div> -->
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                              <BreezeLabel for="last_name" value="Last Name" />
                               <BreezeInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />  
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="email" value="Email" />
                            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="phone" value="Phone" />
                            <BreezeInput id="phone_number" type="number" class="mt-1 block w-full" v-model="form.phone_number" required autofocus autocomplete="phone_number" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="address" value="Address" />
                            <BreezeInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autofocus autocomplete="address" />
                        </div>

                         <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="role" value="Role" />
                            <select class="mt-1 block w-full" v-model="form.role" id="">
                                    <option value="">Select Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                            </select>
                        </div>


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
     user: Object
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
            first_name: props.user.first_name,
            last_name: props.user.last_name,
            email: props.user.email,
            role:props.user.role,
            phone_number:props.user.phone_number,
            address:props.user.address
       });

        // const submit = () => {
        //     form.put(route('clients.update',client.id));
        // };

        return {form}  
        
       
   
   }

  
   
};
</script>
