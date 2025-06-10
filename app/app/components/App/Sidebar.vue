<script setup lang="ts">
import type { DropdownMenuItem, NavigationMenuItem } from '@nuxt/ui'

const { $state, tenants } = useTenantStore()
const { sidebar } = useDashboard()

const top = ref<NavigationMenuItem[][]>([[{
    label: 'Dashboard',
    type: 'label'
}, {
    label: 'Summary',
    icon: Icon.Stats,
    to: '/',
}, {
    label: 'Attributions',
    icon: Icon.Attribution,
    to: '/attributions',
}, {
    label: 'Campaigns',
    icon: Icon.Campaign,
    to: '/campaigns',
    badge: {
        label: 'Pro',
        color: 'primary',
        ui: { base: 'py-0.5' }
    },
}], [{
    label: 'Shop Management',
    type: 'label'
}, {
    label: 'Integrations',
    icon: Icon.Integration,
    to: '/integrations',
}, {
    label: 'Cost & Expenses',
    icon: Icon.Cost,
    to: '/costs',
}, {
    label: 'UTM Tracking',
    icon: Icon.Tracking,
    to: '/tracking',
    badge: {
        label: 'Pro',
        color: 'primary',
        ui: { base: 'py-0.5' }
    },
}, {
    label: 'Settings',
    icon: Icon.Settings,
    to: '/settings'
}]])

const bottom = ref<NavigationMenuItem[][]>([[{
    label: 'Feedback',
    icon: Icon.Feedback,
    disabled: true,
    trailingIcon: Icon.OpenInNewTab,
    ui: {
        linkTrailingIcon: 'size-3'
    }
}, {
    label: 'Help',
    icon: Icon.Help,
    disabled: true,
    trailingIcon: Icon.OpenInNewTab,
    ui: {
        linkTrailingIcon: 'size-3'
    }
}]])

const dropdowns = ref<DropdownMenuItem[][]>([[{
    label: 'Profile',
    icon: Icon.User,
    to: '/account/profile'
}, {
    label: 'Notifications',
    icon: Icon.Bell,
    to: '/account/notifications'
}], [{
    label: 'Billing',
    icon: Icon.CreditCard,
    to: '/account/billing'
}], [{
    label: 'Logout',
    color: 'error',
    icon: Icon.LogOut,
    to: '/auth/login',
    onSelect: async () => {
        // supabase.auth.signOut()
        await navigateTo('/auth/login', {
            redirectCode: 301
        })
    }
}]])

watch(() => $state.tenant, () => {
    sidebar.value = false
    refreshNuxtData()
})
</script>

<template>
    <div class="flex flex-col h-screen overflow-y-auto divide-y rounded-none divide-default">
        <div class="flex items-center p-4 gap-1 h-(--ui-sidebar-height)">
            <UIcon :name="Icon.Brand" class="size-8 me-2" />
            <USelectMenu v-model="$state.tenant" :items="tenants" variant="soft" :trailing-icon="$state.tenant?.icon" label-key="name" :ui="{ base: 'truncate', value: '!font-semibold' }" />
            <ColorModeButton />
            <slot name="headerEnd" />
        </div>
        <div class="flex flex-col justify-between p-4 space-y-4 grow">
            <CommandPallete>
                <UButton label="Search" :icon="Icon.Search" variant="outline" color="neutral" block :ui="{ base: 'justify-between', label: 'grow text-start' }">
                    <template #trailing>
                        <code class="text-muted">/</code>
                    </template>
                </UButton>
            </CommandPallete>
            <UNavigationMenu orientation="vertical" :items="top" />
            <div class="grow" />
            <UCard variant="soft" :ui="{ root: 'bg-primary/5', body: '!p-4 space-y-4 relative' }">
                <div class="font-semibold mb-1">Become a Pro</div>
                <div class="text-xs text-muted">Unlock advanced features and priority support.</div>
                <UButton to="/settings/plans" color="primary" variant="soft" block label="Upgrade Now" :icon="Icon.Rocket" />
            </UCard>
            <UNavigationMenu orientation="vertical" :items="bottom" />
        </div>
        <div class="flex !p-4 items-center h-(--ui-sidebar-height) gap-1">
            <UDropdownMenu :items="dropdowns" variant="ghost" :ui="{ content: 'min-w-68' }" :content="{ align: 'start' }">
                <UButton label="John Doe" :icon="Icon.UserCircle" color="neutral" variant="ghost" block :ui="{ base: 'justify-between', label: 'grow text-start' }" />
            </UDropdownMenu>
            <UButton :icon="Icon.Bell" color="neutral" variant="ghost" />
        </div>
    </div>
</template>