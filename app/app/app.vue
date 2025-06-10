<script lang="ts" setup>
const colorMode = useColorMode()

const color = computed(() => colorMode.value === 'dark' ? '#1b1718' : 'white')

useHead({
    titleTemplate: '%s - Invoice',
    meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { key: 'theme-color', name: 'theme-color', content: color }
    ],
    link: [
        { rel: 'icon', type: 'image/svg+xml', href: '/favicon.svg' },
    ],
    htmlAttrs: {
        lang: 'en'
    }
})

const title = 'Invoice'
const description = 'Transform data complexity into profitable growth with Invoice, the agent-powered intelligence platform that powers faster, more confident decisions.'

useSeoMeta({
    title,
    description,
    ogTitle: title,
    ogDescription: description,
    ogImage: 'https://assets.hub.nuxt.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1cmwiOiJodHRwczovL2Rhc2hib2FyZC10ZW1wbGF0ZS5udXh0LmRldiIsImlhdCI6MTczOTQ2MzU2N30._VElt4uvLjvAMdnTLytCInOajMElzWDKbmvOaMZhZUI.jpg?theme=light',
    twitterImage: 'https://assets.hub.nuxt.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1cmwiOiJodHRwczovL2Rhc2hib2FyZC10ZW1wbGF0ZS5udXh0LmRldiIsImlhdCI6MTczOTQ2MzU2N30._VElt4uvLjvAMdnTLytCInOajMElzWDKbmvOaMZhZUI.jpg?theme=light',
    twitterCard: 'summary_large_image'
})

// const session = useSupabaseSession()
// const { getTenants } = useTenantStore()

// await callOnce('tenant', () => {
//     if (session.value) {
//         return getTenants()
//     }
// })
</script>

<template>
    <UApp>
        <NuxtLoadingIndicator />
        <NuxtLayout>
            <NuxtPage />
        </NuxtLayout>
    </UApp>
</template>