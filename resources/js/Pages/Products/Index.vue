<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    products: Array
});

function destroy(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        router.delete(`/products/${id}`, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <Head title="My Products" />

    <AdminLayout>
        <template #header>
            <h2 class="text-2xl font-bold mb-4">Product List</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <Link
                            href="/products/create"
                            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block"
                        >
                            Create Product
                        </Link>

                        <div v-if="$page.props.flash?.success" class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                            {{ $page.props.flash.success }}
                        </div>

                        <table class="min-w-full bg-white border">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border">Name</th>
                                    <th class="py-2 px-4 border">Description</th>
                                    <th class="py-2 px-4 border">Price</th>
                                    <th class="py-2 px-4 border">Image</th>
                                    <th class="py-2 px-4 border">Status</th>
                                    <th class="py-2 px-4 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td class="py-2 px-4 border font-semibold text-blue-700">
                                        <Link :href="`/products/${product.id}`">{{ product.name }}</Link>
                                    </td>
                                    <td class="py-2 px-4 border">{{ product.description }}</td>
                                    <td class="py-2 px-4 border">${{ product.price.toFixed(2) }}</td>
                                    <td class="py-2 px-4 border">
                                        <img :src="product.image_url" alt="Image" class="w-16 h-16 object-cover" />
                                    </td>
                                    <td class="py-2 px-4 border capitalize">{{ product.status }}</td>
                                    <td class="py-2 px-4 border">
                                        <Link
                                            :href="`/products/${product.id}/edit`"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2 transition"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="destroy(product.id)"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
