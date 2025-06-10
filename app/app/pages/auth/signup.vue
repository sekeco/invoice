<script lang="ts" setup>
definePageMeta({
    layout: 'auth',
    sanctum: {
        guestOnly: true
    }
}) 
</script>

<template>
    <AuthPage title="Join us">
        <template #description>
            <span>Already have an account? <ULink to="/auth/signin">Login</ULink></span>
        </template>
        <AuthSignUpForm />
        <USeparator label="OR" />
        <AuthWithGoogle />
    </AuthPage>
</template>