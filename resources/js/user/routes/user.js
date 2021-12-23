import Dahsboard from './../components/user/Dashboard.vue';
import Profile from './../components/user/Profile.vue';

export default [
    { path: '/dashboard', component: Dahsboard , name: 'user.dashboard' },
    { path: '/profile', component: Profile , name: 'user.profile'}
 ];