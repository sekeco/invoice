import { Icon } from './icon'
import { today, CalendarDate, DateFormatter, getLocalTimeZone, startOfWeek, endOfWeek, startOfMonth, endOfMonth, startOfYear, endOfYear } from '@internationalized/date'

export interface StatWidget {
    key: string
    label: string
    icon: string
    format?: any
    description?: string
}

export interface StatChannel {
    label: string
    icon: string
    widgets?: StatWidget[]
}

export interface DateRangePreset {
    label: string
    dates: [CalendarDate, CalendarDate],
    hidePresetLabel?: boolean
}

export const Enum = {
    StatChannel: {
        pins: {
            label: 'Pins',
            icon: Icon.Pin,
        } as StatChannel,
        store: {
            label: 'Store',
            icon: Icon.Brand,
            widgets: [
                { key: 'store.trueaov', label: 'True AOV', icon: Icon.Brand, format: toCurrency, description: 'Average order value after returns and discounts.' },
                { key: 'store.aov', label: 'Average Order Value', icon: Icon.Brand, format: toCurrency, description: 'Average value of all store orders.' },
                { key: 'store.sales', label: 'Sales', icon: Icon.Brand, format: toCurrency, description: 'Total sales revenue from the store.' },
                { key: 'store.orders', label: 'Orders', icon: Icon.Brand, format: toCurrency, description: 'Total number of orders placed in store.' },
                { key: 'store.customers', label: 'Customers', icon: Icon.Brand, description: 'Number of unique customers in store.' },
                { key: 'store.products', label: 'Products', icon: Icon.Brand, description: 'Total number of products in store.' },
            ]
        } as StatChannel,
        googleads: {
            label: 'Google Ads',
            icon: Icon.GoogleIcon,
            widgets: [
                { key: 'googleads.spend', label: 'Spend', icon: Icon.GoogleIcon, format: toCurrency, description: 'Total ad spend on Google Ads.' },
                { key: 'googleads.conversions', label: 'Conversions', icon: Icon.GoogleIcon, format: toCurrency, description: 'Number of conversions from Google Ads.' },
                { key: 'googleads.cpa', label: 'CPA', icon: Icon.GoogleIcon, format: toPercentage, description: 'Average cost per acquisition on Google Ads.' },
                { key: 'googleads.cpc', label: 'CPC', icon: Icon.GoogleIcon, format: toPercentage, description: 'Average cost per click on Google Ads.' }
            ]
        } as StatChannel,
        metaads: {
            label: 'Meta Ads',
            icon: Icon.MetaIcon,
            widgets: [
                { key: 'metaads.spend', label: 'Spend', icon: Icon.MetaIcon, format: toCurrency, description: 'Total ad spend on Meta Ads.' },
                { key: 'metaads.conversions', label: 'Conversions', icon: Icon.MetaIcon, format: toCurrency, description: 'Number of conversions from Meta Ads.' },
                { key: 'metaads.cpa', label: 'CPA', icon: Icon.MetaIcon, format: toPercentage, description: 'Average cost per acquisition on Meta Ads.' },
                { key: 'metaads.cpc', label: 'CPC', icon: Icon.MetaIcon, format: toPercentage, description: 'Average cost per click on Meta Ads.' },
                { key: 'metaads.reach', label: 'Reach', icon: Icon.MetaIcon, description: 'Total unique users reached by Meta Ads.' },
                { key: 'metaads.impressions', label: 'Impressions', icon: Icon.MetaIcon, description: 'Total number of Meta Ads impressions.' }
            ]
        } as StatChannel,
        tiktokads: {
            label: 'TikTok Ads',
            icon: Icon.TikTokIcon,
            widgets: [
                { key: 'tiktokads.spend', label: 'Spend', icon: Icon.TikTokIcon, format: toCurrency, description: 'Total ad spend on TikTok Ads.' },
                { key: 'tiktokads.conversions', label: 'Conversions', icon: Icon.TikTokIcon, format: toCurrency, description: 'Number of conversions from TikTok Ads.' },
                { key: 'tiktokads.cpa', label: 'CPA', icon: Icon.TikTokIcon, format: toPercentage, description: 'Average cost per acquisition on TikTok Ads.' },
                { key: 'tiktokads.cpc', label: 'CPC', icon: Icon.TikTokIcon, format: toPercentage, description: 'Average cost per click on TikTok Ads.' },
                { key: 'tiktokads.views', label: 'Views', icon: Icon.TikTokIcon, description: 'Total number of TikTok Ads video views.' },
                { key: 'tiktokads.clicks', label: 'Clicks', icon: Icon.TikTokIcon, description: 'Total number of clicks from TikTok Ads.' }
            ]
        } as StatChannel
    } as Record<string, StatChannel>,
    CurrencyOptions: [
        { label: 'USD', value: 'USD' },
        { label: 'EUR', value: 'EUR' },
        { label: 'GBP', value: 'GBP' },
        { label: 'JPY', value: 'JPY' },
        { label: 'AUD', value: 'AUD' },
    ],
    GridLayoutOptions: [
        { label: 'Two', value: 2 },
        { label: 'Three', value: 3 },
        { label: 'Four', value: 4 },
    ],
    DecimalOptions: [
        { label: '-', value: 0 },
        { label: '.0', value: 1 },
        { label: '.00', value: 2 },
    ],
    SummarySection: {
        pins: { label: 'Pins' },
        store: { label: 'Store' },
        attribution: { label: 'Attribution' },
        google: { label: 'Google' },
        facebook: { label: 'Facebook' }
    },
    LanguageOptions: [
        { label: 'English', value: 'en' },
    ],
    ThemeOptions: [
        { label: 'System', value: 'system', icon: Icon.LaptopMinimal },
        { label: 'Light', value: 'light', icon: Icon.Sun },
        { label: 'Dark', value: 'dark', icon: Icon.Moon }
    ],
    DateRangeCurrentPreset: [
        { label: 'Today', dates: [today(getLocalTimeZone()), today(getLocalTimeZone())] },
        { label: 'Yesterday', dates: [today(getLocalTimeZone()).subtract({ days: 1 }), today(getLocalTimeZone()).subtract({ days: 1 })] },
        { label: 'Last 7 Days', dates: [today(getLocalTimeZone()).subtract({ days: 6 }), today(getLocalTimeZone())] },
        { label: 'Last 30 Days', dates: [today(getLocalTimeZone()).subtract({ days: 29 }), today(getLocalTimeZone())] },
        { label: 'Last 90 Days', dates: [today(getLocalTimeZone()).subtract({ days: 89 }), today(getLocalTimeZone())] },
        { label: 'Last 365 Days', dates: [today(getLocalTimeZone()).subtract({ days: 364 }), today(getLocalTimeZone())] },
        { label: 'Last week', dates: [startOfWeek(today(getLocalTimeZone()).subtract({ weeks: 1 }), 'en-US'), endOfWeek(today(getLocalTimeZone()).subtract({ weeks: 1 }), 'en-US')] },
        { label: 'Last month', dates: [startOfMonth(today(getLocalTimeZone()).subtract({ months: 1 })), endOfMonth(today(getLocalTimeZone()).subtract({ months: 1 }))] },
        { label: 'Last year', dates: [today(getLocalTimeZone()).subtract({ years: 1 }).set({ month: 1, day: 1 }), today(getLocalTimeZone()).subtract({ years: 1 }).set({ month: 12, day: 31 })] },
        { label: 'This week', dates: [today(getLocalTimeZone()).set({ day: 1 }), endOfWeek(today(getLocalTimeZone()), 'en-US')] },
        { label: 'This month', dates: [today(getLocalTimeZone()).set({ day: 1 }), endOfMonth(today(getLocalTimeZone()))] },
        { label: 'This year', dates: [today(getLocalTimeZone()).set({ month: 1, day: 1 }), today(getLocalTimeZone()).set({ month: 12, day: 31 })] },
    ] as DateRangePreset[],
    ShippingZoneTypeOptions: ['Worldwide', 'Specific country'] as string[],
    ShippingRateSettingOptions: ['Fixed Rate', 'Order weight-based tiered rates'] as string[]
}