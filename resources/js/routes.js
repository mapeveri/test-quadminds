import VueRouter from 'vue-router';
import CrudNotes from './views/CrudNotes';
import FormNote from './views/FormNote';
import ShowNote from './views/ShowNote';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'notes',
            component: CrudNotes
        },
        {
            path: '/new',
            name: 'formAddNote',
            component: FormNote,
        },
        {
            path: '/edit/:id',
            name: 'formEditNote',
            component: FormNote,
        },
        {
            path: '/show/:id',
            name: 'showNote',
            component: ShowNote,
        },
    ],
});

export default router;
