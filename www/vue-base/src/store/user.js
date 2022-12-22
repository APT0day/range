import { defineStore } from 'pinia'
import settings from '@/settings'

export const userStore = defineStore("user", () => {
    state: () => ({
        count: 1,
        // return {
        //     count: 0,
        //     settings: settings
        // }
    })
})