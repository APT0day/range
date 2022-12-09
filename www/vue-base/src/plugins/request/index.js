import axios from 'axios'
import { setBlockTracking } from 'vue'

function errorCreate(msg) {
    const err = new Error(msg)
    errorLog(err)
    throw err
}

function errorLog(err) {

}

// 创建一个 axios 实例
const service = axios.create({
    baseURL: setBlockTracking.apiBaseURL,
    timeout: 60000, // 请求超时时间
    withCredentials: true, // 允许携带 cookie
    headers: { Pragma: 'no-cache' } // 对付ie缓存问题
})

// 请求拦截器
service.interceptors.request.use(
    config => {

    }
)

export default service