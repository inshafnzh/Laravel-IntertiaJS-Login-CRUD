<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  students: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
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
                    <div class="p-6 text-gray-900 overflow-x-auto">
  <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
    
    <!-- Table Head -->
    <thead class="bg-gray-100">
      <tr>
        <th class="text-left px-4 py-2 border-b">ID</th>
        <th class="text-left px-4 py-2 border-b">Profile</th>
        <th class="text-left px-4 py-2 border-b">Name</th>
        <th class="text-left px-4 py-2 border-b">Age</th>
        <th class="text-left px-4 py-2 border-b">Status</th>
        <th class="text-center px-4 py-2 border-b">Actions</th>
      </tr>
    </thead>

    <!-- Table Body -->
    <tbody>
      <tr
        v-for="student in students"
        :key="student.id"
        class="hover:bg-gray-50 transition"
      >
        <td class="px-4 py-2 border-b">
          {{ student.id }}
        </td>  

        <td class="px-4 py-2 border-b">
            <img
                v-if="student.image"
                :src="`/storage/${student.image}`"
                alt="Profile"
                class="w-16 h-16 object-cover rounded"
            />
        </td>

        <td class="px-4 py-2 border-b">
          {{ student.name }}
        </td>

        <td class="px-4 py-2 border-b">
          {{ student.age }}
        </td>

        <td class="px-4 py-2 border-b">
          {{ student.status }}
        </td>

        <td class="px-4 py-2 border-b text-center space-x-2">
          
          <!-- Edit -->
          <Link
            :href="`/edit/${student.id}`"
            as="button"
            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm"
          >
            Edit
          </Link>

          <!-- Delete -->
          <Link
            :href="`/delete/${student.id}`"
            method="delete"
            as="button"
            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
          >
            Delete
          </Link>

        </td>
      </tr>
    </tbody>
  </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
