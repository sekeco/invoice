<script setup lang="ts">
const colorMode = useColorMode()

const isDark = computed({
    get() {
        return colorMode.value === 'dark'
    },
    set() {
        colorMode.preference = colorMode.value === 'dark' ? 'light' : 'dark'
    }
})
</script>

<template>
    <ClientOnly v-if="!colorMode?.forced">
        <slot :color-mode="colorMode">
            <UButton :icon="isDark ? Icon.Moon : Icon.Sun" color="neutral" variant="ghost" @click="isDark = !isDark" />
        </slot>
        <template #fallback>
            <UButton :icon="Icon.LaptopMinimal" color="neutral" variant="ghost" disabled />
        </template>
    </ClientOnly>
</template>
