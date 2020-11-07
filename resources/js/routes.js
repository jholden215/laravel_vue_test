import Layout from './pages/Layout.vue'
import Player from './pages/Player.vue'
import viewPlayer from './pages/viewPlayer.vue'
export const routes = [
    {
        path:'/',
        component:Layout
    },
    {
        path:'/player',
        component:Player
    },
    {
        path:'/view-players/:id',
        component:viewPlayer
    },
];