<template>
  <div class="p-8">
    <h2 class="text-2xl font-bold mb-4">Library Books</h2>
    <div>
      <form @submit.prevent="submitBook">
        <input v-model="form.title" placeholder="Book Title" class="border p-2 mb-2" />
        <input v-model="form.author" placeholder="Author" class="border p-2 mb-2" />
        <input v-model="form.year_published" placeholder="Year Published" class="border p-2 mb-2" />
        <button class="bg-blue-500 text-white px-4 py-2">Add Book</button>
      </form>
    </div>
    <ul class="mt-4">
      <li v-for="book in books" :key="book.id">
        <strong>{{ book.title }}</strong> by {{ book.author }} ({{ book.year_published }})
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

defineProps({
  books: Array,
});

const form = useForm({
  title: '',
  author: '',
  year_published: ''
});

const submitBook = () => {
  form.post('/dashboard/books');
};
</script>
