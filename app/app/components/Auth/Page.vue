<script lang="ts" setup>
const props = defineProps<{
    title?: string,
    description?: string
}>()

useHead({
    title: props.title
})
</script>

<template>
    <div class="space-y-8">
        <div class="space-y-2 text-center">
            <slot name="title">
                <h1 class="text-2xl" v-text="title" />
            </slot>
            <slot name="description">
                <h2 class="text-muted" v-text="description" />
            </slot>
        </div>
        <main class="space-y-6">
            <slot />
        </main>
    </div>
</template>