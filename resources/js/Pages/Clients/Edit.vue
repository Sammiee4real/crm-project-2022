<template>
    <Head title="Clients" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="flex justify-between items-center font-semibold text-sm text-gray-800 leading-tight">
                <div class="text-xl">Edit Client: {{client.contact_name}}</div> <span><Link :href="route('clients.index')" as="button" class="bg-indigo-800 p-2 rounded-xl text-white">All Clients</Link></span>
            </h2>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-1 md:gap-6">
             
                <div class="mt-5 md:mt-0 md:col-span-1 md:mx-auto md:w-1/2">
                <form @submit.prevent="form.put(route('clients.update',client.id))">
                    <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="col-span-6 sm:col-span-3">
                               <BreezeValidationErrors class="mb-4" />
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                        
                        <div class="col-span-6 sm:col-span-3">
                               <BreezeLabel for="contact_name" value="Contact Name" />
                               <BreezeInput id="contact_name" type="text" class="mt-1 block w-full" v-model="form.contact_name" required autofocus autocomplete="contact_name" />
                               <!-- <div v-if="form.errors.contact_name">{{ form.errors.contact_name }}</div> -->
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                              <BreezeLabel for="contact_email" value="Contact Email" />
                               <BreezeInput id="contact_email" type="email" class="mt-1 block w-full" v-model="form.contact_email" required autofocus autocomplete="contact_email" />  
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_name" value="Company Name" />
                            <BreezeInput id="company_name" type="text" class="mt-1 block w-full" v-model="form.company_name" required autofocus autocomplete="company_name" />
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_name" value="Contact Phone No" />
                            <BreezeInput id="company_name" type="number" class="mt-1 block w-full" v-model="form.contact_phone_number" required autofocus autocomplete="contact_phone_number" />
                        </div>

                         <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_address" value="Company Address" />
                            <BreezeInput id="company_address" type="text" class="mt-1 block w-full" v-model="form.company_address" required autofocus autocomplete="company_address" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_city" value="Company City" />
                            <BreezeInput id="company_city" type="text" class="mt-1 block w-full" v-model="form.company_city" required autofocus autocomplete="company_city" />
                       
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_vat" value="Company VAT" />
                            <BreezeInput id="company_vat" type="number" class="mt-1 block w-full" v-model="form.company_vat" required autofocus autocomplete="company_vat" />
                          
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <BreezeLabel for="company_zip" value="Company Zip" />
                            <BreezeInput id="company_zip" type="text" class="mt-1 block w-full" v-model="form.company_zip" required autofocus autocomplete="company_zip" />
                             
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
     client: Object
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
        contact_name: props.client.contact_name,
        contact_email: props.client.contact_email,
        company_name: props.client.company_name,
        contact_phone_number:props.client.contact_phone_number,
        company_address: props.client.company_address,
        company_city: props.client.company_city,
        company_vat: props.client.company_vat,
        company_zip: props.client.company_zip,
       });

        // const submit = () => {
        //     form.put(route('clients.update',client.id));
        // };

        return {form}  
        
       
   
   }

  
   
};
</script>
