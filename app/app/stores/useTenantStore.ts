import { defineStore } from 'pinia'

export interface Tenant {
    id: number;
    name: string;
    platform: string;
    icon: any;
    connected: boolean;
}

export const useTenantStore = defineStore("tenant", () => {
    const tenants = ref<Array<Tenant>>([])
    const tenant = useCookie<Tenant | undefined>('tenant')

    async function getTenants() {
        tenants.value = await $fetch('/api/getTenants')
        if (!tenant.value && tenants.value.length > 0) {
            tenant.value = tenants.value[0]
        }
    }

    return {
        tenants,
        tenant,
        getTenants,
    }
})