<template>
  <div class="mb-3">
    Welcome Home!
  </div>
  <div class="mb-3">
    <Link href="/posts" class="btn btn-md btn-primary">POST DATA</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
  name: "Home",
  components: {
    Link
  },
};
</script>

<style scoped>
/* Tambahkan gaya khusus untuk komponen ini di sini */
</style>
