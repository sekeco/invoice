<script lang="ts" setup>
const { label = 'Continue with Google' } = defineProps<{
    label?: string
}>()

// const { auth } = useSupabaseClient()

async function submit() {
    // await auth.signInWithOAuth({
    //     provider: 'google',
    //     options: {
    //         redirectTo: window?.location?.origin
    //     }
    // })
}
</script>

<template>
    <UButton color="neutral" variant="outline" :icon="Icon.GoogleIcon" block :label="label" disabled @click="submit" />
</template>