import { createStore } from 'vuex'
import settings from '@/settings'

export default createStore({
    state: {
        couter: 0,
        
    },
    mutations: {
        add(state) {
            state.counter++
        }
    },
    modules: {
        settings
    }
})