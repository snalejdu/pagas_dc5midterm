<template>
  <div class="min-h-screen flex flex-col bg-gradient-to-b from-blue-50 to-gray-100 relative">
    <div class="absolute top-6 right-6">
      <button
        @click="goToDashboardOrLogin"
        class="rounded-md px-5 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-lg transition duration-200"
      >
        Dashboard
      </button>
    </div>

    <div class="flex-1 flex flex-col justify-center items-center text-center px-4">
      <h1 class="text-5xl font-extrabold text-blue-700 drop-shadow-md">Library Book Borrowing System</h1>
      <p class="mt-5 text-lg text-gray-700 max-w-xl">
        Manage your library book collection and borrow books easily. Start now by logging in or registering!
      </p>

      <div class="mt-8 flex flex-col sm:flex-row sm:space-x-6 space-y-4 sm:space-y-0">
        <button
          v-if="!user && canRegister"
          @click="goToRegister"
          class="rounded-lg px-8 py-3 bg-green-600 text-white font-semibold hover:bg-green-700 shadow-md transition duration-200"
        >
          Register
        </button>
        <button
          v-if="!user"
          @click="goToLogin"
          class="rounded-lg px-8 py-3 bg-gray-700 text-white font-semibold hover:bg-gray-800 shadow-md transition duration-200"
        >
          Log In
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Welcome",
  computed: {
    user() {
      return this.$page.props.auth?.user ?? null;
    },
    canRegister() {
      return true;
    }
  },
  methods: {
    goToDashboardOrLogin() {
      if (this.user) {
        this.$inertia.visit(this.route('dashboard'));
      } else {
        this.$inertia.visit(this.route('login'));
      }
    },
    goToRegister() {
      this.$inertia.visit(this.route('register'));
    },
    goToLogin() {
      this.$inertia.visit(this.route('login'));
    }
  }
};
</script>

<style scoped>
</style>
