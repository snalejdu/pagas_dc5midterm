<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();
const user = page.props.auth?.user ?? { name: '', email: '' };
const books = ref(page.props.books ?? []);


const form = useForm({
  id: null,
  title: '',
  author: '',
  isbn: '',
  published_at: ''
});
const editing = ref(false);

const editBook = (book) => {
  form.id = book.id;
  form.title = book.title;
  form.author = book.author;
  form.isbn = book.isbn;
  form.published_at = book.published_at;
  editing.value = true;
};


const updateBook = () => {
  form.put(route('books.update', form.id), {
    onSuccess: (page) => {
      form.reset();
      editing.value = false;
      books.value = page.props.books;
    }
  });
};


const deleteBook = (book) => {
  if (confirm(`Are you sure you want to delete "${book.title}"?`)) {
    form.delete(route('books.destroy', book.id), {
      onSuccess: (page) => {
        books.value = page.props.books;
      }
    });
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
    </template>

    <div class="py-12 max-w-5xl mx-auto space-y-6">

      <div class="bg-white p-6 rounded shadow">
        <p><strong>Name:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
      </div>


      <div v-if="editing" class="bg-white p-6 rounded shadow">
        <h3 class="font-bold mb-3">Edit Book</h3>
        <div class="space-y-2">
          <input v-model="form.title" placeholder="Title" class="border p-2 w-full rounded"/>
          <input v-model="form.author" placeholder="Author" class="border p-2 w-full rounded"/>
          <input v-model="form.isbn" placeholder="ISBN" class="border p-2 w-full rounded"/>
          <input v-model="form.published_at" type="date" class="border p-2 w-full rounded"/>
          <div class="space-x-2 mt-2">
            <button @click="updateBook" class="bg-green-600 text-white px-4 py-2 rounded">Update Book</button>
            <button @click="form.reset(); editing=false" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded shadow">
        <h3 class="font-bold mb-3">Books</h3>
        <table class="w-full border">
          <thead class="bg-gray-100">
            <tr>
              <th class="border px-3 py-2">Title</th>
              <th class="border px-3 py-2">Author</th>
              <th class="border px-3 py-2">ISBN</th>
              <th class="border px-3 py-2">Published</th>
              <th class="border px-3 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in books" :key="book.id">
              <td class="border px-3 py-2">{{ book.title }}</td>
              <td class="border px-3 py-2">{{ book.author }}</td>
              <td class="border px-3 py-2">{{ book.isbn }}</td>
              <td class="border px-3 py-2">{{ book.published_at }}</td>
              <td class="border px-3 py-2 space-x-2">
                <button @click="editBook(book)" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button @click="deleteBook(book)" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
            <tr v-if="books.length === 0">
              <td colspan="5" class="text-center py-4 text-gray-500">No books available.</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </AuthenticatedLayout>
</template>
