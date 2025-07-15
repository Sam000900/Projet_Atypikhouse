<script setup>
  import { computed } from 'vue';
  import { Link, usePage } from '@inertiajs/vue3';
  import { LogOut } from 'lucide-vue-next';
  import index from '@/store/index.js';
  import logoAtypikHouse from'@/../../public/images/logo-atypik-house.png';

  const { sidebarCollapsed, toggleSidebar } = index();
  const page = usePage();
  const user = computed(() => page.props.auth?.user);
  const navTabs = [
      { text: 'Dashboard', href: 'dashboard', icon: 'Chart', forRole: ['owner', 'admin'] },
      { text: 'Réservations', href: 'dashboard/reservations', icon: 'Calendar', forRole: ['tenant'] },
      { text: 'Articles', href: 'dashboard/articles', icon: 'NoteText', forRole: ['admin'] },
      { text: 'Experiences', href: 'dashboard/experiences', icon: 'SunFog', forRole: ['admin'] },
      { text: 'Logements', href: 'dashboard/logements', icon: 'House', forRole: ['owner', 'admin'] },
      // { text: 'Messages', href: 'accueil', icon: 'Messages2', forRole: [] },
      // { text: 'Finances', href: 'accueil', icon: 'DollarCircle', forRole: [] },
      // { text: 'Statistiques', href: 'accueil', icon: 'StatusUp', forRole: [] },
      // { text: 'Avis ', href: 'accueil', icon: 'Star1', forRole: [] },
      // { text: 'Assitance ', href: 'accueil', icon: 'InfoCircle', forRole: [] },
      { text: 'Paramètres ', href: 'accueil', icon: 'Setting2', forRole: ['owner', 'tenant', 'admin'] }
  ];
  const filteredTabs = computed(() => {
    if (!user.value) return [];
    return navTabs.filter(tab => tab.forRole.includes(user.value.role));
  });
</script>

<template>
  <div class="sidebar" :class="sidebarCollapsed ? 'sidebar-collapsed' : 'sidebar-expended'">
    <img :src="logoAtypikHouse" alt="logo atypik house" class="sidebar-logo" />
    <div class="sidebar-nav-content">
      <div class="sidebar-nav">
        <Link
          v-for="tab in filteredTabs"
          :class="{'sidebar-nav-tab-active': '/' + tab.href === page.url}"
          :key="tab.title"
          :href="route(tab.href)"
          as="button"
          class="sidebar-nav-tab"
        >
          <VsxIcon :iconName="tab.icon" size="25" :color="'/' + tab.href === page.url ? '#296242' : '#5D6679'" type="linear" />
          <p class="sidebar-nav-text" :class="{'sidebar-nav-text-active': '/' + tab.href === page.url}">{{ tab.text }}</p>
        </Link>
      </div>
      <div class="sidebar-bottom">
        <button class="sidebar-burger-menu">
          <VsxIcon v-if="sidebarCollapsed" @click="toggleSidebar" iconName="SidebarRight" size="25" color="#5D6679" type="linear" class="sidebar-menu-size" />
          <VsxIcon v-else @click="toggleSidebar" iconName="SidebarLeft" size="25" color="#5D6679" type="linear" class="sidebar-menu-size" />
        </button>
        <Link v-if="user" method="post" :href="route('logout')" class="sidebar-logout"><LogOut class="sidebar-logout-icon" /></Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .sidebar {
    display: flex;
    align-items: center;
    flex-direction: column;
    height: 100vh;
    background-color: #ffffff;
    transition: 0.25s;
  }

  .sidebar-expended {
    z-index: 9999;
    width: 300px;
  }

  .sidebar-collapsed {
    z-index: 9999;
    width: 50px;
  }

  .sidebar-collapsed .sidebar-nav {
    padding: 40px 5px 0 5px;
    transition: 0.25s;
  }

  .sidebar-collapsed .sidebar-nav-text {
    display: none;
  }

  .sidebar-collapsed .sidebar-logo {
    display: none;
  }

  .sidebar-collapsed .sidebar-bottom {
    flex-direction: column;
    gap: 5px;
    height: auto;
    padding: 5px 0;
  }

  .sidebar-nav-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: column;
    width: 100%;
    padding-bottom: 20px;
  }

  .sidebar-logo {
    width: 120px;
    padding: 20px 0;
  }

  .sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 5px;
    width: 100%;
    padding: 0 20px;
  }

  .sidebar-nav-tab {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    width: 100%;
    height: 40px;
    padding: 0 10px;
    border: 0;
    border-radius: 8px;
    background-color: transparent;
    cursor: pointer;
  }

  .sidebar-nav-tab:hover {
    background-color: #DCFCE7;
  }

  .sidebar-nav-tab-active {
    background-color: #B6C9BE;
  }

  .sidebar-nav-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #5D6679;
  }

  .sidebar-nav-text-active {
    color: #296242;
    font-weight: bold;
  }

  .sidebar-bottom{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 40px;
    padding: 0 20px;
    background-color: #DCFCE7;
  }

  .sidebar-burger-menu{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    border-radius: 8px;
    background-color: transparent;
    border: 0;
  }

  .sidebar-menu-size {
    cursor: pointer;
  }

  .sidebar-logout {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 0;
    background-color: transparent;
    color: crimson;
    cursor: pointer;
  }

  .sidebar-logout-icon {
    width: 20px;
    height: 20px;
  }

  @media screen and (max-width: 1000px) {
    .sidebar {
      position: fixed;
    }
  }
</style>