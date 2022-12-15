import request from '@/utils/request'

export function fetchUserInfo(id) {
    return request({
        url: 'api/sql/sql1',
        method: 'get',
        params: { id }
    })
}