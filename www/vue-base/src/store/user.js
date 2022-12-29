import { defineStore } from 'pinia'
import settings from '@/settings'

export const userStore = defineStore('user', {
    state: () => ({
        token: null
    }),
    actions: {
        setToken(token) {
            this.token = token
        }
    }
})