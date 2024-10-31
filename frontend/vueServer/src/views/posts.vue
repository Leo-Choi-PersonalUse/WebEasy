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
                <h5 class="font-semibold text-lg dark:text-white-light">Posts</h5>


                <div class="flex items-center flex-wrap">
                    <div class="">
                        <!-- Trigger -->
                        <button type="button" class="btn btn-primary btn-sm m-1" @click="modal1 = true">
                            <icon-plus class="w-5 h-5 ltr:mr-2 rtl:ml-2" />
                            Add New
                        </button>

                        <!-- Modal -->
                        <TransitionRoot appear :show="modal1" as="template">
                            <Dialog as="div" @close="modal1 = false" class="relative z-[51]">
                                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                    leave-to="opacity-0">
                                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                                </TransitionChild>

                                <div class="fixed inset-0 overflow-y-auto">
                                    <div class="flex min-h-full items-center justify-center px-4 py-8">
                                        <TransitionChild as="template" enter="duration-300 ease-out"
                                            enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                            leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                            leave-to="opacity-0 scale-95">
                                            <DialogPanel
                                                class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                                <button type="button"
                                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                                    @click="modal1 = false">
                                                    <icon-x />
                                                </button>
                                                <div
                                                    class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                                    Post
                                                </div>
                                                <form class="space-y-5 p-8">
                                                    <div>
                                                        <label for="groupTitle">Title</label>
                                                        <input id="groupTitle" type="text" placeholder="Enter Title"
                                                            v-model="title" class="form-input" />
                                                    </div>
                                                    <div>
                                                        <label for="groupContent">Content</label>
                                                        <input id="groupContent" type="text" placeholder="Enter Content"
                                                            v-model="content" class="form-input" />
                                                    </div>
                                                    <button type="button" class="btn btn-primary !mt-6"
                                                        @click="submitData">Submit</button>
                                                </form>
                                            </DialogPanel>
                                        </TransitionChild>
                                    </div>
                                </div>
                            </Dialog>
                        </TransitionRoot>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm m-1" @click="deleteButtonHandler">
                        <icon-trash class="w-5 h-5 ltr:mr-2 rtl:ml-2" />
                        Delete
                    </button>
                    <button type="button" class="btn btn-primary btn-sm m-1">
                        <icon-plus class="w-5 h-5 ltr:mr-2 rtl:ml-2" />
                        TXT
                    </button>

                </div>
                <div class="ltr:ml-auto rtl:mr-auto">
                    <input v-model="search" type="text" class="form-input w-auto" placeholder="Search..." />
                </div>
            </div>

            <div class="datatable">
                <vue3-datatable ref="datatable" :rows="rows" :columns="cols" :totalRows="rows?.length" :search="search"
                    :hasCheckbox="true" :sortable="true" skin="whitespace-nowrap bh-table-hover"
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
import { ref, onMounted } from 'vue';
import Vue3Datatable from '@bhplugin/vue3-datatable';
import { useMeta } from '@/composables/use-meta';
import IconPlus from '@/components/icon/icon-plus.vue';
import IconBell from '@/components/icon/icon-bell.vue';
import IconTrash from '@/components/icon/icon-trash.vue';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
//import { helloWorld } from '@/globalFunction';
import { useAppStore } from '@/stores/index';
import { apiService } from '@/appservice';
import { getSelectedRows, deleteSelectedRows } from '@/utils';


useMeta({ title: 'Default Order Sorting Table' });
const store = useAppStore();
const search = ref('');
const title = ref('');
const content = ref('');
const modal1 = ref(false);
const datatable: any = ref(null);
const cols =
    ref([
        { field: 'id', title: 'ID', isUnique: true },
        { field: 'title', title: 'Title' },
        { field: 'content', title: 'Content' },
    ]) || [];
const rows = ref([]);

onMounted(async () => {
    try {
        store.showEasyLoading();
        let data = await apiService().restfulAPI({ endpoint: "posts", method: "GET" });
        rows.value = data;
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
    finally {
        store.dismissEasyLoading();
    }
});

const submitData = async () => {
    const postData = ref({
        title: title.value,
        content: content.value,
    });
    debugger;
    try {
        store.showEasyLoading();
        await apiService().restfulAPI({ endpoint: "posts", method: "POST", body: postData.value });
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
    finally {
        location.reload();
    }
};

const getdatatableRef = () => { return datatable.value }

async function deleteButtonHandler() {

    let selectedRow = getSelectedRows(getdatatableRef());
    let ids_arr = selectedRow.map((e) => e.id);
    rows.value = rows.value.filter((e) => ids_arr.includes(e["id"]) == false)

    // store.showEasyLoading();
    // let res = await deleteSelectedRows({ tableName: "posts", id_list: ids_arr });
    // store.dismissEasyLoading();

    // rows.value = rows.value.filter((e) => ids_arr.include(e["id"]) == false)
}


</script>
