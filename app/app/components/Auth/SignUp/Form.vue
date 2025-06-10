<script setup lang="ts">
import type { Form, FormSubmitEvent } from '#ui/types'

defineProps<{
    size?: "md" | "xs" | "sm" | "lg" | "xl"
}>()

const emit = defineEmits<{
    success: [email: string]
}>()

// const { auth } = useSupabaseClient()

interface Schema {
    name?: string
    email?: string
    password?: string
}

const state = reactive<any>({
    name: '',
    email: '',
    password: '',
})

const errorMessage = ref('')
const loading = ref(false)
const form = ref<Form<Schema>>()

async function onSubmit(event: FormSubmitEvent<Schema>) {
    loading.value = true
    // const { data, error } = await auth.signUp({
    //     email: state.email,
    //     password: state.password,
    //     options: {
    //         data: {
    //             full_name: state.name
    //         }
    //     }
    // });
    // if (error) {
    //     errorMessage.value = error.message
    //     loading.value = false
    //     return
    // }

    return emit('success', state.email)
}
</script>

<template>
    <UForm ref="form" :state="state" class="space-y-4" @submit="onSubmit">
        <UFormField label="Full name" name="name" required :size="size">
            <UInput v-model="state.name" autofocus />
        </UFormField>
        <UFormField label="Email" name="email" required :size="size">
            <UInput v-model="state.email" />
        </UFormField>
        <UFormField label="Password" name="password" required :size="size">
            <UInput v-model="state.password" type="password" />
        </UFormField>
        <UAlert v-if="errorMessage" variant="soft" color="error" :description="errorMessage" />
        <UButton type="submit" :loading="loading" block label="Sign Up" :size="size" />
    </UForm>
</template>