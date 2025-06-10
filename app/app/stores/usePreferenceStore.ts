import { defineStore } from 'pinia'

export interface Preference {
    summary: {
        stats: Record<string, string[]> & {
            pins: string[]
        }
        layout: {
            grid: number
            fluid: boolean
        }
    }
    language: 'en',
    theme: 'system' | 'light' | 'dark',
    currency: string
    decimal: number
}

export const usePreferenceStore = defineStore("preference", () => {
    const preference = reactive<Preference>({
        summary: {
            stats: {
                pins: [
                    'tiktokads.spend', 'store.aov', 'googleads.spend', 'metaads.spend', 'metaads.conversions'
                ],
                store: [
                    'store.trueaov', 'store.aov', 'store.sales', 'store.orders', 'store.customers', 'store.products'
                ],
                googleads: [
                    'googleads.spend', 'googleads.conversions', 'googleads.cpa', 'googleads.cpc'
                ],
                metaads: [
                    'metaads.spend', 'metaads.conversions', 'metaads.cpa', 'metaads.reach'
                ],
                tiktokads: [
                    'tiktokads.spend', 'tiktokads.conversions', 'tiktokads.views', 'tiktokads.clicks'
                ]
            },
            layout: {
                grid: 4,
                fluid: false
            },
        },
        language: 'en',
        theme: 'system',
        currency: 'USD',
        decimal: 2
    });

    async function togglePin(pin: string): Promise<void> {
        const index = preference.summary.stats.pins.indexOf(pin);
        if (index > -1) {
            preference.summary.stats.pins.splice(index, 1);
        } else {
            preference.summary.stats.pins.push(pin);
        }
    }

    return { preference, togglePin }
})