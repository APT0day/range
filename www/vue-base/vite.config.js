import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    // 别名
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
    // 省略文件扩展名
    extensions: ['.js', '.ts', '.jsx', '.tsx', '.json', '.vue']
  }
})
