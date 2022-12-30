<template>
    <div>
        <Dropdown trigger="click" @on-click="handleClick">
            <Avatar src="../../src/assets/avatar.webp" />
            <span class="layout-header-right-username">亚索</span>
            <template #list>
                <DropdownMenu>
                    <DropdownItem>
                        <Icon type="ios-contact-outline" />
                        <span>工作台</span>
                    </DropdownItem>
                    <DropdownItem divided name="logout">
                        <Icon type="ios-log-out" />
                        <span>logout</span>
                    </DropdownItem>
                </DropdownMenu>
            </template>
        </Dropdown>
    </div>
</template>

<script setup>
function handleClick(name) {
    if(name === 'logout') {
        $router.push('/login')
    }
}
</script>
