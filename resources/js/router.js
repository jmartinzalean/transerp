import VueRouter from 'vue-router'

// Pages
import Home from './pages/AppLayout';
import Login from './pages/Login';
import AdminDashboard from './pages/admin/Dashboard';
import Dashboard from './pages/Dashboard';
import Clients from './pages/admin/clients/ClientIndex';

// Routes
const routes = [
    {
        path: '/',
        component: Home,
        meta: {
          auth: true
        },
        children : [
            {path:'', name: 'dashboard', component: Dashboard},
            {path:'clients', name: 'clients', component: Clients}
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
          auth: false
        }
    },
    // ADMIN ROUTES
    {
        path: '/admin',
        name: 'admin.dashboard',
        component: AdminDashboard,
        meta: {
          auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
        }
    },
];

const router = new VueRouter({
  routes,
});

export default router
