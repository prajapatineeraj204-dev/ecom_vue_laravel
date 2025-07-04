<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object
});
</script>

<template>
    <Head :title="product.name" />

    <AdminLayout>
        <template #header>
            <h2 class="text-2xl font-bold mb-4">Product Details</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="max-w-xl mx-auto">
                            <img :src="product.image_url" alt="Image" class="w-48 h-48 object-cover mb-4 mx-auto" />

                            <div class="mb-2">
                                <span class="font-semibold">Description:</span> {{ product.description }}
                            </div>

                            <div class="mb-2">
                                <span class="font-semibold">Price:</span> ${{ product.price }}
                            </div>

                            <div class="mb-2">
                                <span class="font-semibold">Status:</span> {{ product.status }}
                            </div>

                            <div class="mt-4 flex gap-2">
                                <Link :href="`/products/${product.id}/edit`" class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Edit
                                </Link>
                                <Link href="/products" class="bg-gray-300 text-gray-800 px-4 py-2 rounded">
                                    Back
                                </Link>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
