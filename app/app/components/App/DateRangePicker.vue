<script setup lang="ts">
import { today, DateFormatter, getLocalTimeZone } from '@internationalized/date'
import type { DateRangePreset } from '~~/shared/utils/enum'

const df = new DateFormatter('en-US', {
    dateStyle: 'short'
})

const modelValue = defineModel({
    default: {
        start: today(getLocalTimeZone()),
        end: today(getLocalTimeZone())
    }
})

const props = withDefaults(defineProps<{
    presets?: DateRangePreset[]
    class?: string
    noCompare?: boolean
    icon?: string
    showPresetDate?: boolean
}>(), {
    presets: () => Enum.DateRangeCurrentPreset,
    noCompare: false
})

const matchedPreset = computed(() => props.presets.find(p => p.dates[0]?.toString() == modelValue.value.start?.toString() && p.dates[1]?.toString() == modelValue.value.end?.toString()))

const open = ref(false)
watch(modelValue, () => {
    open.value = false
})
</script>

<template>
    <UPopover v-model:open="open">
        <UButton color="neutral" variant="outline" :icon="props.icon" :trailing-icon="Icon.ChevronDown" :ui="{ base: 'justify-between', trailingIcon: 'text-dimmed', leadingIcon: 'text-dimmed' }">
            <span class="truncate">
                <template v-if="props.noCompare">No comparison</template>
                <template v-else-if="modelValue.start && modelValue.end">
                    <template v-if="matchedPreset">
                        {{ matchedPreset?.label }}
                    </template>
                    <template v-else>
                        {{ df.format(modelValue.start.toDate(getLocalTimeZone())) }} - {{ df.format(modelValue.end.toDate(getLocalTimeZone())) }}
                    </template>
                </template>
                <template v-else-if="modelValue.start">
                    {{ df.format(modelValue.start.toDate(getLocalTimeZone())) }}
                </template>
                <template v-else>
                    Pick a date
                </template>
            </span>
        </UButton>

        <template #content>
            <div class="flex divide-x divide-default">
                <div class="flex flex-col gap-0.5 p-2 max-h-72 overflow-y-auto">
                    <UButton v-for="(preset, i) in presets" :key="i" :variant="matchedPreset?.label == preset.label ? 'soft' : 'ghost'" :color="matchedPreset?.label == preset.label ? 'primary' : 'neutral'" @click="modelValue = { start: preset.dates[0], end: preset.dates[1] }" :label="preset.label" class="w-32 py-1">
                        <template #default v-if="props.showPresetDate">
                            <div class="flex flex-col items-start">
                                <div>{{ preset.label }}</div>
                                <div v-if="!preset.hidePresetLabel" class="text-xs text-dimmed">{{ df.format(preset.dates[0].toDate(getLocalTimeZone())) }} - {{ df.format(preset.dates[1].toDate(getLocalTimeZone())) }}</div>
                            </div>
                        </template>
                    </UButton>
                </div>
                <UCalendar v-model="modelValue" class="p-2" :number-of-months="1" range />
            </div>
        </template>
    </UPopover>
</template>
