<template>
    <div>
        <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">
            <div class="rounded-full bg-primary p-1.5 text-white ring-2 ring-primary/30 ltr:mr-3 rtl:ml-3">
                <icon-bell />
            </div>
            <span class="ltr:mr-3 rtl:ml-3">Documentation: </span>
            <a href="https://www.npmjs.com/package/@bhplugin/vue3-datatable" target="_blank"
                class="block hover:underline">
                https://www.npmjs.com/package/@bhplugin/vue3-datatable
            </a>
        </div>

        <div class="panel pb-0 mt-6">
            <div class="flex md:items-center md:flex-row flex-col mb-5 gap-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Order Sorting</h5>
                <div class="ltr:ml-auto rtl:mr-auto">
                    <input v-model="search" type="text" class="form-input w-auto" placeholder="Search..." />
                </div>
            </div>

            <div class="datatable">
                <vue3-datatable :rows="rows" :columns="cols" :totalRows="rows?.length" :search="search" :sortable="true"
                    skin="whitespace-nowrap bh-table-hover"
                    firstArrow='<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
                    lastArrow='<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg> '
                    previousArrow='<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'
                    nextArrow='<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>'>
                </vue3-datatable>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted, h } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import { useMeta } from '@/composables/use-meta';
import IconBell from '@/components/icon/icon-bell.vue';
import VueCookies from 'vue-cookies';

useMeta({ title: 'Default Order Sorting Table' });
const search = ref('');
const cookies = VueCookies.hasOwnProperty('VueCookies') ? VueCookies.VueCookies : VueCookies;
const cols =
    ref([
        { field: 'id', title: 'ID', isUnique: true },
        { field: 'name', title: 'Name' },
        { field: 'email', title: 'Email' },
    ]) || [];
const rows = ref(
    [
        // {
        //     id: 1,
        //     firstName: 'Caroline',
        //     lastName: 'Jensen',
        //     email: 'carolinejensen@zidant.com',
        //     dob: '2004-05-28',
        //     address: {
        //         street: '529 Scholes Street',
        //         city: 'Temperanceville',
        //         zipcode: 5235,
        //         geo: {
        //             lat: 23.806115,
        //             lng: 164.677197,
        //         },
        //     },
        //     phone: '+1 (821) 447-3782',
        //     isActive: true,
        //     age: 39,
        //     company: 'POLARAX',
        // },
    ] || []
);

onMounted(async () => {
    try {
        const response = await fetch('http://localhost/backend/api/v1/users', {
            headers: {
                'Authorization': `Bearer ${cookies.get('token')}`,
                'Content-Type': 'application/json',
            }
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        rows.value = data;
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
});
</script>
