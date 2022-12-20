<script setup>
import { reactive, ref } from 'vue'

const form = reactive({
    username: 'admin',
    password: 'admin'
})

const rule = reactive({
    username: [{
        required: true,
        message: 'Username cannot be empty',
        trigger: 'blur'
    }],
    password: [{
        required: true,
        message: 'Password cannot be empty',
        trigger: 'blur'
    }]
})



function handleSubmit() {
    if (form.username && form.password) {
        console.log(form.username)
        console.log(form.password)
        console.log(routes)
    }else {
        console.log('error')
    }
}
</script>

<template>
    <div class="account">
        <Card class="account-card" :bordered="false" dis-hover>
            <div class="account-card-title">
                <span>通用后台管理系统</span>
            </div>
            <Form :rules="rule">
                <FormItem prop="username">
                    <Input type="text" v-model="form.username" placeholder="请输入用户名" size="large"
                        prefix="ios-contact-outline" />
                </FormItem>
                <FormItem prop="password">
                    <Input type="password" v-model="form.password" placeholder="请输入密码" size="large"
                        prefix="ios-lock-outline" password />
                </FormItem>
                <FormItem>
                    <div class="account-card-reset"><a>忘记密码</a></div>
                    <Button type="primary" size="large" @click="handleSubmit" long>登录</Button>
                    <div class="account-card-register">还没有账号?<a>注册账号</a></div>
                </FormItem>
            </Form>
        </Card>
    </div>
</template>
