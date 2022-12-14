const meta = {
    auth: true
};

const pre = 'sql-';

export default {
    path: '/sql',
    name: 'sql',
    redirect: {
        name: `${pre}sql1`
    },
    meta: {
        ...meta,
        title: 'sql',
        icon: 'ios-paper'
    },
    component: () => import('@/layouts/index.vue'),
    children: [
        {
            path: 'sql1',
            name: `${pre}sql1`,
            meta: {
                ...meta,
                title: 'sql1',
            },
            component: () => import('@/views/sql/sql1.vue')
        }
    ]
};
