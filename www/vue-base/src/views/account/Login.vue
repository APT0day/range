<script setup>
import { ref } from 'vue'

const form = ref({
    username: '',
    password: ''
})

function handleSubmit(valid, { username, password }) {
    if (valid) {
        this.$Modal.info({
            title: '输入的内容如下：',
            content: 'username: ' + username + ' | password: ' + password
        });
    }
}
</script>

<template>
    <div class="login">
        <Card class="box-card" :bordered="false" dis-hover>
            <div class="title">
                <span>通用后台管理系统</span>
            </div>
            <Form ref="form" :model="form">
                <FormItem prop="username">
                    <Input type="text" v-model="form.user" placeholder="请输入用户名" size="large"
                        prefix="ios-contact-outline" />
                </FormItem>
                <FormItem prop="password">
                    <Input type="password" v-model="form.password" placeholder="请输入密码" size="large"
                        prefix="ios-lock-outline" password />
                </FormItem>
                <FormItem>
                    <div class="reset"><a>忘记密码</a></div>
                    <Button type="primary" size="large" @click="handleSubmit" long>登录</Button>
                    <div class="register">还没有账号?<a>注册账号</a></div>
                </FormItem>
            </Form>
        </Card>
    </div>
</template>

<style>
.login {
    width: 100%;
    height: 100%;
    margin: 0 auto !important;
    position: absolute;
    background: #409EFF;
}

.box-card {
    position: absolute;
    width: 400px;
}

.title {
    text-align: center;
    font-size: 34px;
}

.reset a {
    float: right;
}

.register {
    text-align: center;
}
</style>