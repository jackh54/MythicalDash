import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/views/auth/Login.vue';
import Register from '@/views/auth/Register.vue';
import ForgotPassword from '@/views/auth/ForgotPassword.vue';

import NotFound from '@/views/errors/NotFound.vue';
import Forbidden from '@/views/errors/Forbidden.vue';
import ServerError from '@/views/errors/ServerError.vue';
import ResetPassword from '@/views/auth/ResetPassword.vue';
import DashboardUi from '@/views/Home.vue';
import DashboardAccount from '@/views/Account.vue';
import TicketDashboard from '@/views/ticket/List.vue';
import TicketDetail from '@/views/ticket/[id].vue';
import TwoFactorSetup from '@/views/auth/TwoFactorSetup.vue';

import AdminSettings from '@/views/admin/Settings.vue';
import AdminUsers from '@/views/admin/Users.vue';
import AdminTickets from '@/views/admin/Tickets.vue';
import AdminDashboard from '@/views/admin/Home.vue';
import AdminEula from '@/views/admin/Eula.vue';
import Adminannouncements from '@/views/admin/announcements.vue';
import AdminAddons from '@/views/admin/Addons.vue';
import AdminBackups from '@/views/admin/Backups.vue';
import AdminApikeys from '@/views/admin/Apikeys.vue';
import AdminLogs from '@/views/admin/Logs.vue';
import AdminLanguages from '@/views/admin/Languages.vue';
import AdminRoles from '@/views/admin/Roles.vue';

const routes = [
    {
        path: '/auth/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/auth/register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/auth/forgot-password',
        name: 'Forgot Password',
        component: ForgotPassword,
    },
    {
        path: '/auth/reset-password',
        name: 'Reset Password',
        component: ResetPassword,
    },
    {
        path: '/auth/two-factor-setup',
        name: 'Two Factor Setup',
        component: TwoFactorSetup,
    },
    {
        path: '/errors/403',
        name: 'Forbidden',
        component: Forbidden,
    },
    {
        path: '/errors/500',
        name: 'ServerError',
        component: ServerError,
    },
    {
        path: '/',
        name: 'Dashboard',
        component: DashboardUi,
    },
    {
        path: '/account',
        name: 'Account',
        component: DashboardAccount,
    },
    {
        path: '/ticket',
        name: 'Ticket',
        component: TicketDashboard,
    },
    {
        path: '/ticket/:id',
        name: 'Ticket Detail',
        component: TicketDetail,
    },
    {
        path: '/admin/settings',
        name: 'Settings',
        component: AdminSettings,
    },
    {
        path: '/admin/users',
        name: 'Users',
        component: AdminUsers,
    },
    {
        path: '/admin/tickets',
        name: 'Tickets',
        component: AdminTickets,
    },
    {
        path: '/admin',
        name: 'Admin Dashboard',
        component: AdminDashboard,
    },
    {
        path: '/admin/eula',
        name: 'Eula',
        component: AdminEula,
    },
    {
        path: '/admin/announcements',
        name: 'announcements',
        component: Adminannouncements,
    },
    {
        path: '/admin/addons',
        name: 'Addons',
        component: AdminAddons,
    },
    {
        path: '/admin/backups',
        name: 'Backups',
        component: AdminBackups,
    },
    {
        path: '/admin/apikeys',
        name: 'Apikeys',
        component: AdminApikeys,
    },
    {
        path: '/admin/logs',
        name: 'Logs',
        component: AdminLogs,
    },
    {
        path: '/admin/languages',
        name: 'Languages',
        component: AdminLanguages,
    },
    {
        path: '/admin/roles',
        name: 'Roles',
        component: AdminRoles,
    },
];

routes.push({
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound,
});

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
