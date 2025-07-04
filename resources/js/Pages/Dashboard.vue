<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const productCount = usePage().props.productCount;
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold mb-4">Welcome to the Dashboard!</h2>
                        <div class="mt-8 flex flex-col sm:flex-row gap-6">
                            <div class="flex-1 bg-blue-100 border border-blue-300 rounded-lg p-6 flex flex-col items-center justify-center">
                                <div class="text-4xl font-bold text-blue-700">{{ productCount }}</div>
                                <div class="text-lg text-blue-800 mt-2 mb-4">Products</div>
                                <Link href="/products" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">View Products</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
