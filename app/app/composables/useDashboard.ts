export default function () {
    const route = useRoute()

    const sidebar = useState<boolean>('sidebar', () => false)

    watch(() => route.path, () => {
        sidebar.value = false
    })

    return {
        sidebar
    }
}