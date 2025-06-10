<script setup lang="ts">
import type { Form, FormSubmitEvent } from '#ui/types'

defineProps<{
    size?: "md" | "xs" | "sm" | "lg" | "xl"
}>()

const emit = defineEmits<{
    success: []
}>()

interface Schema {
    email?: string
    password?: string & { maxLength: 10 }
    remember?: boolean
}

const isDev = computed(() => !!location?.origin.includes('localhost'))

const { login } = useSanctumAuth();
const errorMessage = ref('')
const loading = ref<boolean>(false)
const form = ref<Form<Schema>>()
const togglePassword = ref<boolean>(false)
const state = reactive<any>({
    email: undefined,
    password: undefined,
    remember: true
})

async function onSubmit(event: FormSubmitEvent<Schema>) {
    loading.value = true
    try {
        await login(state)
        emit('success')
    } catch (error: any) {
        errorMessage.value = error.message || 'An error occurred during login.'
        form.value!.clear()
        loading.value = false
        return
    }
}

onMounted(() => {
    if (isDev.value) {
        state.email = 'rasyid@sekeco.id'
        state.password = 'password'
    }
})
</script>

<template>
    <UForm ref="form" :state="state" class="space-y-4" @submit="onSubmit">
        <UFormField label="Email" name="email" required :size="size">
            <UInput v-model="state.email" />
        </UFormField>
        <UFormField label="Password" name="password" required :size="size">
            <template #hint>
                <ULink to="/auth/password/forgot">Forgot password</ULink>
            </template>
            <UInput v-model="state.password" :type="togglePassword ? 'text' : 'password'" :ui="{ trailing: 'pe-1' }">
                <template #trailing>
                    <UButton color="neutral" variant="link" :icon="togglePassword ? Icon.EyeOff : Icon.Eye" @click="togglePassword = !togglePassword" />
                </template>
            </UInput>
        </UFormField>
        <UFormField name="remember">
            <UCheckbox v-model="state.remember" label="Remember session" />
        </UFormField>
        <UAlert v-if="errorMessage" variant="soft" color="error" :description="errorMessage" />
        <UButton type="submit" :loading="loading" block label="Login" :size="size" />
    </UForm>
</template>