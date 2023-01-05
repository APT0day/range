import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
    state: () => ({
        token: null
    }),
    actions: {
        setToken(token) {
            this.token = token
        }
    }
})
