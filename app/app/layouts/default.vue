<script setup lang="ts">

</script>

<template>
    <div class="flex h-screen divide-x divide-default">
        <AppSidebar as="aside" class="hidden rounded-none lg:flex w-72" />
        <div class="flex-1 bg-elevated/25 h-screen overflow-y-auto">
            <slot />
        </div>
    </div>
</template>