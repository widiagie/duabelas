// require('./bootstrap');

// import { createApp, h } from 'vue'
// import { App, plugin } from '@inertiajs/inertia-vue3'

// const el = document.getElementById('app')

// createApp({
//   render: () => h(App, {
//     initialPage: JSON.parse(el.dataset.page),
//     resolveComponent: name => require(`./Pages/${name}`).default,
//   })
// }).use(plugin).mount(el)


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init();

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});
