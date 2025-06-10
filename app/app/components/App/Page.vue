<script lang="ts" setup>
const props = withDefaults(defineProps<{
    title?: string,
    full?: boolean,
    fluid?: boolean,
    divided?: boolean,
    icon?: string
}>(), {
    title: 'Dashboard',
    full: false,
    fluid: false,
    divided: false,
})

const { sidebar } = useDashboard()

useHead({
    title: props.title
})
</script>

<template>
    <div class="flex flex-col min-h-screen divide-y divide-default">
        <LazyUSlideover v-model:open="sidebar" side="left">
            <template #title />
            <template #description />
            <template #content>
                <LazyAppSidebar>
                    <template #headerEnd>
                        <UButton :icon="Icon.Close" color="neutral" variant="ghost" @click="sidebar = !sidebar" />
                    </template>
                </LazyAppSidebar>
            </template>
        </LazyUSlideover>
        <div class="flex flex-col lg:flex-row items-center gap-0 lg:gap-2 divide-y divide-default lg:divide-none overflow-none w-full lg:px-4">
            <div class="flex items-center gap-2 h-(--ui-sidebar-height) px-4 w-full lg:w-auto lg:px-0">
                <UButton :icon="Icon.SidebarToggle" color="neutral" variant="ghost" class="flex lg:hidden" @click="sidebar = !sidebar" />
                <slot name="header">
                    <div class="flex items-center gap-2 me-4 h-(--ui-sidebar-height)">
                        <UIcon v-if="props.icon" :name="props.icon" />
                        <h1 class="font-semibold" v-text="title || ''" />
                    </div>
                </slot>
            </div>
            <div v-if="$slots.headerEnd" class="flex justify-between items-center gap-2 px-4 lg:px-0 ms-auto h-(--ui-sidebar-height) overflow-x-auto w-full dark:bg-elevated/50 dark:lg:bg-transparent">
                <slot name="headerEnd"></slot>
            </div>
        </div>
        <UContainer as="main" :class="['py-4', { '!p-0 max-w-full': props.full, '!px-4 max-w-full': props.fluid, 'divide-y divide-default': props.divided }]">
            <slot />
        </UContainer>
    </div>
</template>