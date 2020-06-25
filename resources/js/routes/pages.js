/*STANDARD*/
import Vue from 'vue';
import VueRouter from 'vue-router';
import Users from '../components/user/Users'
import UsersEdit from '../components/user/UsersEdit'
import UsersNew from '../components/user/UsersNew'
import password from '../components/user/changepass';
import uservalidate from '../components/user/validate'
import start from '../components/pages/start'
import logout from '../components/pages/logout'
import noAutorizate from '../components/pages/noAutorizate'
import PageNotFound from '../components/pages/error404'
/*STANDARD*/
import encuesta from '../components/response/index'
import preguntas from '../components/preguntas/form'



//#endregion
const prefix = '/dashboard';
const prefix2 = '/encuesta';
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes: [
        { 
            path: prefix2 + '/response/:name',
            name: 'responseencuesta',
            component: encuesta,
            meta: 
            {
                auth: false,
                title:'Nueva encuesta',
                roles:['admin','supervisor','observador']
            }
        },
        { 
            path: prefix2 + '/preguntas/:name',
            name: 'preguntas',
            component: preguntas,
            meta: 
            {
                auth: false,
                title:'preguntas',
                roles:['admin','supervisor','observador']
            }
        },
        
            
        
        /*STANDARD*/
        {path: prefix + '/start',name: 'start',component: start},
        { path: prefix + '/index', redirect: { name: 'uservalidate' }},
        { path: prefix + '/logout', name: 'logout', component: logout},
        { path: prefix + '/usuarios',name: 'users',component: Users,meta: {auth: true,title:'Usuarios',roles:['admin','supervisor','observador']}},
        { path: prefix + '/usuarios/edit/:id',name: 'usersedit',component: UsersEdit,meta: {auth: true,title:'Editar usuario',roles:['admin','supervisor','observador']}},
        { path: prefix + '/uservalidate',name: 'uservalidate',component: uservalidate,meta: {auth: true,title:'',roles:['admin','supervisor','observador']}},
        { path: prefix + '/usuarios/nuevo',name: 'usersnew',component: UsersNew,meta: {auth: true,title:'Nuevo usuario',roles:['admin','supervisor','observador']}},
        { path: prefix + '/usuarios/cambiarpass',name: 'cambiarpass',component: password,meta: {auth: true,title:'Cambiar contraseña',roles:['user','admin','supervisor','observador']}},
        { path: "*", redirect:  { name: 'error404' }, component: PageNotFound, meta: { auth: false, title:'Sitio no encontrado' } },
        { path: prefix + "/accesodenegado", name: 'noAutorizate', component: noAutorizate, meta: { auth: false, title:'No autorizado'} },
        /*STANDARD*/
    ]
});
router.beforeEach((to, from, next) =>
{
    const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
    const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
    const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
    if(nearestWithTitle) document.title = nearestWithTitle.meta.title;
    Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));
    if(!nearestWithMeta) return next();
    nearestWithMeta.meta.metaTags.map(tagDef =>
    {
        const tag = document.createElement('meta');
        Object.keys(tagDef).forEach(key => {
            tag.setAttribute(key, tagDef[key]);
        });
        tag.setAttribute('data-vue-router-controlled', '');
        return tag;
    })
    .forEach(tag => document.head.appendChild(tag));
    next();
});
export default router;
