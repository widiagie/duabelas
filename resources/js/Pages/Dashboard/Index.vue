<template>
  <div class="mt-5">
    <h1>Dashboard</h1>
    <p>Today's Date: {{ todayDate }}</p>
    <!-- flash message -->
    <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
      {{ $page.props.flash.message }}
    </div>
    <!-- flash message -->
    <div class="mb-3">
      <Link href="/posts/create" class="btn btn-md btn-primary">TAMBAH DATA</Link>
    </div>
    <div class="card border-0 rounded shadow-sm">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">DATE</th>
              <th scope="col">ITEMS</th>
              <th scope="col" class="text-center w-25">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for="report in reports.data" :key="report.id">
                <td class="w-25">{{ formatDate(report.fr_date) }}</td>
                <td>{{ report.fr_item }}</td>
                <td class="text-center w-25">
                    <Link :href="`/dashboard/${report.id}/edit`" class="btn btn-sm btn-primary me-2">EDIT</Link>
                    <button @click.prevent="deletePost(report.id)" class="btn btn-sm btn-danger">DELETE</button>
                </td>
              </tr>
          </tbody>
        </table>
        <!-- Pagination Links -->
        <Bootstrap5Pagination :data="reports" @pagination-change-page="getReports" class="custom-pagination"/>
      </div>
    </div>
  </div>
</template>

<script>
import LayoutApp from '../../Layouts/App.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';

export default {
  layout: LayoutApp,
  components: {
    Link,
    Bootstrap5Pagination
  },
  props: {
    todayDate: String,
    reports: Object,
  },
  methods: {
    getReports(page = 1) {
      Inertia.get(`/dashboard?page=${page}`);
    },
    formatDate(dateStr) {
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      const date = new Date(dateStr);
      return date.toLocaleDateString('id-ID', options).replace(/ /g, ' ');
    },
  }
}
</script>

<style scoped>
.mt-5 {
  margin-top: 2rem;
}
</style>
