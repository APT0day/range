import { defineStore } from 'pinia'
import settings from '@/settings'

export const layoutStore = defineStore('layout', {
    state: () => ({
        settings: settings.layout
    })
})