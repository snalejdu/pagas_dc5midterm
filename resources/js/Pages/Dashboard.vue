<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
const books = page.props.books ?? [];
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">

        <!-- User Info -->
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
          <p><strong>Name:</strong> {{ user.name }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>
        </div>

        <!-- Books Section -->
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
          <h3 class="text-lg font-bold mb-4">Books</h3>

          <table class="w-full border">
            <thead class="bg-gray-100">
              <tr>
                <th class="border px-3 py-2">Title</th>
                <th class="border px-3 py-2">Author</th>
                <th class="border px-3 py-2">ISBN</th>
                <th class="border px-3 py-2">Published</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="book in books" :key="book.id">
                <td class="border px-3 py-2">{{ book.title }}</td>
                <td class="border px-3 py-2">{{ book.author }}</td>
                <td class="border px-3 py-2">{{ book.isbn }}</td>
                <td class="border px-3 py-2">{{ book.published_at }}</td>
              </tr>

              <tr v-if="books.length === 0">
                <td colspan="4" class="text-center py-4 text-gray-500">
                  No books available.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
