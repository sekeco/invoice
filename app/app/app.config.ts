export default defineAppConfig({
    ui: {
        icons: {
            loading: Icon.Loading
        },
        colors: {
            primary: 'blue',
            neutral: 'zinc'
        },
        input: {
            slots: {
                root: 'w-full'
            },
        },
        select: {
            slots: {
                base: 'w-full'
            }
        },
        selectMenu: {
            slots: {
                base: 'w-full'
            }
        },
        textarea: {
            slots: {
                root: 'w-full'
            }
        },
        card: {
            slots: {
                root: 'dark:bg-elevated/50'
            }
        }
    },
})
