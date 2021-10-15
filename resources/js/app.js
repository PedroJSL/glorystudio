require('./bootstrap');

import 'remixicon/fonts/remixicon.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import { vClickOutside } from 'click-outside-vue3';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} | ${appName}`, //Modificador de la etiqueta title del head
    resolve: (name) => require(`./Pages/${name}.vue`), //Determina la carga de las páginas al ser solicitadas a traves de las llamadas Inertia::render en el routing
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(vClickOutside)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
