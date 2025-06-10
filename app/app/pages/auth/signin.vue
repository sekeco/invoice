<script lang="ts" setup>
definePageMeta({
    layout: 'auth'
})

const { getTenants } = useTenantStore()

async function onSuccess() {
    await getTenants();
    await navigateTo('/', {
        redirectCode: 302
    })
}
</script>

<template>
    <AuthPage title="Login">
        <template #description>
            <span>Don't have an account? <ULink to="/auth/signup">Register</ULink></span>
        </template>
        <AuthSignInForm @success="onSuccess" />
        <USeparator label="OR" type="dashed" />
        <AuthWithGoogle label="Login with Google" />
    </AuthPage>
</template>