import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/views/client/auth/Login.vue';
import Register from '@/views/client/auth/Register.vue';
import ForgotPassword from '@/views/client/auth/ForgotPassword.vue';

import NotFound from '@/views/client/errors/NotFound.vue';
import Forbidden from '@/views/client/errors/Forbidden.vue';
import ServerError from '@/views/client/errors/ServerError.vue';
import ResetPassword from '@/views/client/auth/ResetPassword.vue';
import DashboardUi from '@/views/client/Home.vue';
import DashboardAccount from '@/views/client/Account.vue';
import TicketDashboard from '@/views/client/ticket/List.vue';
import TicketDetail from '@/views/client/ticket/[id].vue';
import TwoFactorSetup from '@/views/client/auth/TwoFactorSetup.vue';
import TwoFactorVerify from '@/views/client/auth/TwoFactorVerify.vue';
import SSO from '@/views/client/auth/sso.vue';

import AdminHome from '@/views/admin/Home.vue';

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
        path: '/auth/2fa/setup',
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
        path: '/dashboard',
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
        path: '/auth/sso',
        name: 'SSO',
        component: SSO,
    },
    {
        path: '/auth/2fa/setup/disband',
        redirect: () => {
            window.location.href = '/api/auth/2fa/setup/kill';
            return '/api/auth/2fa/setup/kill';
        },
    },
    {
        path: '/auth/logout',
        redirect: () => {
            window.location.href = '/api/user/auth/logout';
            return '/api/user/auth/logout';
        },
    },
    {
        path: '/auth/2fa/verify',
        name: 'Two Factor Verify',
        component: TwoFactorVerify,
    },
    {
        path: '/',
        redirect: '/dashboard',
    },
    {
        path: '/mc-admin',
        name: 'Admin Home',
        component: AdminHome,
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
