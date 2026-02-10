<template>
  <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
  
    <h1 class="text-4xl font-bold text-blue-600"> Library Book Borrowing System</h1>
    <p class="mt-4 text-lg text-gray-700">Manage your library book collection and borrow books. Start now by logging in or signing up!</p>

   
    <div class="mt-6 flex space-x-4">
     
      <button
        v-if="$page.props.auth.user"
        @click="navigateTo('dashboard')"
        class="rounded-md px-6 py-3 bg-blue-600 text-white hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        Dashboard
      </button>

   
      <button
        v-else
        @click="navigateTo('login')"
        class="rounded-md px-6 py-3 bg-gray-600 text-white hover:bg-gray-700 transition focus:outline-none focus:ring-2 focus:ring-gray-500"
      >
        Log in
      </button>

      
      <button
        v-if="!$page.props.auth.user && canRegister"
        @click="navigateTo('register')"
        class="rounded-md px-6 py-3 bg-green-600 text-white hover:bg-green-700 transition focus:outline-none focus:ring-2 focus:ring-green-500"
      >
        Register
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Welcome",
  computed: {

    canRegister() {
      return true; 
    }
  },
  methods: {
    navigateTo(route) {
    
      if (route === 'login') {
        this.$inertia.visit(this.route('login'));
      } else if (route === 'register') {
        this.$inertia.visit(this.route('register'));
      } else if (route === 'dashboard') {
        this.$inertia.visit(this.route('dashboard'));
      }
    }
  }
};
</script>

<style scoped>

</style>
