<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    description: '',
    price: '',
    image: null,
});

const imageInput = ref(null);

function handleFileChange(e) {
    form.image = e.target.files[0];
}

function submit() {
    form.post('/products', {
        preserveScroll: true,
        forceFormData: true,
        onError: () => {
            if (imageInput.value) imageInput.value.value = '';
        },
    });
}
</script>

<template>
    <Head title="Create Product" />

    <AdminLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Product
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label class="block mb-1">Name</label>
                                <input v-model="form.name" type="text" class="border rounded w-full p-2" required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1">Description</label>
                                <textarea v-model="form.description" class="border rounded w-full p-2" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1">Price</label>
                                <input v-model="form.price" type="number" step="0.01" class="border rounded w-full p-2" required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1">Image</label>
                                <input ref="imageInput" @change="handleFileChange" type="file" accept="image/*" class="border rounded w-full p-2" required />
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Create
                            </button>
                            <Link href="/products" class="ml-4 text-gray-600 hover:underline">
                                Cancel
                            </Link>
                        </form>
                        <div v-if="form.errors && Object.keys(form.errors).length"
                             class="bg-red-100 text-red-800 p-2 mt-4 rounded">
                            <div v-for="(error, key) in form.errors" :key="key">{{ error }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
