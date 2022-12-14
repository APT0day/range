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
    // 在请求地址前面加上 baseURL
    baseURL: setBlockTracking.apiBaseURL,
    // 请求超时时间
    timeout: 60000,
    // 当发送跨域请求时允许携带 cookie
    withCredentials: true,
    // 对付ie缓存问题
    headers: { Pragma: 'no-cache' }
})

// 请求拦截器
service.interceptors.request.use(
    (config) => {
        config.headers["X-Token"] = "my token"
        return config
    },
    (error) => {
        // 请求错误的统一处理
        console.log(error)
        return Promise.reject(error)
    }
)

// 响应拦截器
service.interceptors.response.use(
    (response) => {
        const res = response.data

        console.log(res)
    },
    (error) => {
        // 请求错误的统一处理
        console.log(error)
        return Promise.reject(error)
    }
)

export default service