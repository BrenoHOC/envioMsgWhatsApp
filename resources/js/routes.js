const MessageList = () => import('./components/Message/List.vue' /* webpackChunkName: "resource/js/components/Message/list" */)
const MessageCreate = () => import('./components/Message/Create.vue' /* webpackChunkName: "resource/js/components/Message/add" */)
const MessageEdit = () => import('./components/Message/Edit.vue' /* webpackChunkName: "resource/js/components/Message/edit" */)

export const routes = [
    {
        name: 'messageList',
        path: '/message',
        component: MessageList
    },
    {
        name: 'messageCreate',
        path: '/message/add',
        component: MessageCreate
    },
    {
        name: 'messageEdit',
        path: '/message/:id',
        component: MessageEdit
    },
]