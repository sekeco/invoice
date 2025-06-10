<template>
    <div class="grid min-h-screen divide-x auto-rows-max lg:grid-cols-2 divide-muted bg-muted">
        <div class="flex-col gap-6 !p-12 hidden lg:flex justify-between z-0 bg-dot">
            <UIcon :name="Icon.Brand" class="block size-8" />
            <div>
                <h4 class="mb-3 text-3xl max-w-5/6">The only way to do great work is to love what you do.</h4>
                <p class="text-muted">Steve Jobs</p>
            </div>
        </div>
        <div class="relative flex flex-col items-center justify-between h-screen gap-6 !p-4 bg-default z-0">
            <div class="fixed self-end">
                <div class="fixed bg-primary-600 w-[1rem] h-[64rem] rounded-[100%] blur-[5rem] rotate-45 -top-1/2 end-1/6 -z-[1]" />
                <div class="fixed bg-cyan-600 w-[1rem] h-[32rem] rounded-[100%] blur-[4rem] rotate-45 -top-1/3 end-1/4 -z-[1]" />
                <ColorModeButton />
            </div>
            <div class="flex flex-col justify-center w-full max-w-sm grow">
                <div class="mt-6">
                    <slot />
                </div>
            </div>
            <p class="text-xs text-center text-muted">Letstrack &copy; 2025</p>
        </div>
    </div>
</template>