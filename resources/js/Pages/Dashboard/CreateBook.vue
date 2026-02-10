<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  title: '',
  author: '',
  isbn: '',
  published_at: '',
});

const submit = () => {
  form.post(route('books.store'));
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Create New Book
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="submit">
              <div class="space-y-4">
                <div>
                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                  <input type="text" v-model="form.title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                  <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                  <input type="text" v-model="form.author" id="author" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                  <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                  <input type="text" v-model="form.isbn" id="isbn" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                  <label for="published_at" class="block text-sm font-medium text-gray-700">Published Date</label>
                  <input type="date" v-model="form.published_at" id="published_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mt-4">
                  <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md">Create Book</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>
