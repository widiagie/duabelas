<template>
  <div class="mt-5">
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
              <th scope="col">TITLE</th>
              <th scope="col">CONTENT</th>
              <th scope="col" class="text-center w-25">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts.data" :key="post.id">
              <td class="w-25">{{ post.title }}</td>
              <td>{{ post.content }}</td>
              <td class="text-center w-25">
                <Link :href="`/posts/${post.id}/edit`" class="btn btn-sm btn-primary me-2">EDIT</Link>
                <button @click.prevent="deletePost(post.id)" class="btn btn-sm btn-danger">DELETE</button>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- Pagination Links -->
        <Bootstrap5Pagination :data="posts" @pagination-change-page="getPosts" class="custom-pagination"/>
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
    posts: Object,
  },
  methods: {
    getPosts(page = 1) {
      Inertia.get(`/posts?page=${page}`);
    },
    deletePost(id) {
      if (confirm("Are you sure you want to delete this post?")) {
        Inertia.delete(`/posts/${id}`);
      }
    },
  },
};
</script>

<style scoped>
    .custom-pagination .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    }

    .custom-pagination .pagination .page-link {
    color: #4a5568;
    background-color: #f7fafc;
    border: 1px solid #e2e8f0;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    }

    .custom-pagination .pagination .page-link:hover {
    background-color: #edf2f7;
    }

    .custom-pagination .pagination .page-item.active .page-link {
    background-color: #2d3748;
    border-color: #2d3748;
    color: white;
    }

    .custom-pagination .pagination .page-item.disabled .page-link {
    color: #a0aec0;
    background-color: #edf2f7;
    }
</style>
