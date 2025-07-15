import { ref, watchEffect } from 'vue'

const sidebarCollapsed = ref(false)

function toggleSidebar() {
  sidebarCollapsed.value = !sidebarCollapsed.value
}

watchEffect(() => {
  window.innerWidth > 1000 ? sidebarCollapsed.value = false : sidebarCollapsed.value = true
})

export default function useSidebar() {
  return {
    sidebarCollapsed,
    toggleSidebar
  }
}