import { defineStore } from 'pinia'
import settings from '@/settings'

export const userStore = defineStore('user', {
    state: () => ({
        count: 1,
        settings: settings
    })
})