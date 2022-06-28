<template>
    <div>
           <template   v-for="link in links" :key="link.label">
            <Link v-if="link.url" :class="link.active ? 'font-bold':''" :href="link.url" v-html="link.label"></Link>
            <span v-else v-html="link.label"></span>
            </template>

            <!-- <Component
                :is="link.url ? 'Link':'span'"
                v-for="link in links"
                :href="link.url"
                :key="link.label"
                v-html="link.label"
                class="px-1"
                :class="link.url ? '':'text-gray-500'"

             /> -->
    </div>
</template>


<script setup>
   import { Link } from '@inertiajs/inertia-vue3'; 
   defineProps({
            links: Object
   });
</script>