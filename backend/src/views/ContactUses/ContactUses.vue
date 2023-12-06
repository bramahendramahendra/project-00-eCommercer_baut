<template>
    <!-- <pre>{{ contactUses }}</pre> -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Contact Us</h1>
                <!-- <p class="mt-2 text-sm text-gray-700">A list of all the contactUses in your account including their name, title, email and role.</p> -->
            </div>
        </div>
        <ContactUsesTable @clickEdit="editContactUs" />
    </div>
</template>
  
<script setup>
    import { computed, onMounted, ref } from 'vue';
    import store from '../../store';
    import ContactUsesTable from './ContactUsesTable.vue';

    const DEFAULT_CONTACTUS = {
    }

    const contactUses = computed(() => store.state.contactUses)

    const contactUsModel = ref({ ...DEFAULT_CONTACTUS })
    const showContactUsModal = ref(false)

    function showAddNewModal() {
        showContactUsModal.value = true
    }

    function editContactUs(c) {
        store.dispatch('getContactUs', c.id)
            .then(({ data }) => {
                contactUsModel.value = data;
                showAddNewModal();
            })
    }

    function onModalClose() {
        contactUsModel.value = { ...DEFAULT_CONTACTUS }
    }

</script>

<style scoped></style>