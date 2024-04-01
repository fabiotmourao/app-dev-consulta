import { createRouter, createWebHistory } from "vue-router";

export const routes = [
    {
        path: '/',
        name: 'Inicio',
        component: () => import('../components/Inicio.vue'),
    },
    {
        path: '/clientes',
        name: 'Clientes',
        component: () => import('../components/ListaClientes.vue'),
    },
    {
        path: '/cliente/:id/edit',
        name: 'clienteEditar',
        component: () => import('../components/EditarCliente.vue'),
    },
    {
        path: '/candidatos',
        name: 'Candidatos',
        component: () => import('../components/ListaCandidatos.vue'),
    },
    {
        path: '/selecao',
        name: 'Selecao',
        component: () => import('../components/ListaSelecoes.vue'),
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
