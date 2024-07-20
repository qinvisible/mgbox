import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import DefaultLayout from '@/Layouts/Default.vue'
import { PerfectScrollbarPlugin }  from 'vue3-perfect-scrollbar';
import 'vue3-perfect-scrollbar/style.css';

const PerfectScrollbar = PerfectScrollbarPlugin;
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]

    page.default.layout = page.default.layout || DefaultLayout

    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PerfectScrollbar, {
        watchOptions: true,
      })
      .mount(el)
  },
})
