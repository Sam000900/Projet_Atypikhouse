<script setup>
  import { ref, computed  } from 'vue';
  import { Link, usePage } from '@inertiajs/vue3';
  import { LogOut } from 'lucide-vue-next';
  import logoAtypikHouse from'@/../../public/images/logo-atypik-house.png';

  const isMenuMobileOpen = ref(false);

  const page = usePage();
  const user = computed(() => page.props.auth?.user);
</script>

<template>
  <div class="header-marging"></div>
  <header class="header">
    <Link :href="route('accueil')" class="header-logo-link">
      <img :src="logoAtypikHouse" alt="logo atypik house" class="header-logo" />
    </Link>
    <nav class="header-nav">
      <Link :href="route('decouvrir')" class="header-link">Découvrir</Link>
      <Link :href="route('hebergement')" class="header-link">Hébergement</Link>
      <Link :href="route('experiences')" class="header-link">Expériences</Link>
      <Link :href="route('devenir-hote')" class="header-link">Devenir Hôte</Link>
      <Link :href="route('contact')" class="header-link">Contact</Link>
      <Link :href="route('blog')" class="header-link">Blog</Link>
    </nav>
    <div class="header-menu-actions">
      <Link v-if="user" :href="route('dashboard')" class="header-button-dashboard" as="button">Tableau de bord</Link>
      <Link v-if="user" method="post" :href="route('logout')" class="header-button-logout" as="button">Déconnexion</Link>
      <Link v-else :href="route('connexion')" class="header-button" as="button">Connexion / Inscription</Link>
    </div>
    <button
      class="header-responsive-button"
      :class="isMenuMobileOpen ? 'header-responsive-button-opened' : 'header-responsive-button-closed'"
      @click="() => isMenuMobileOpen = !isMenuMobileOpen"
    >
      <div></div>
      <div></div>
      <div></div>
    </button>
  </header>
  <div class="header-menu-mobile" :class="isMenuMobileOpen && 'header-menu-mobile-open'">
    <Link :href="route('decouvrir')" class="header-link-mobile">Découvrir</Link>
    <Link :href="route('hebergement')" class="header-link-mobile">Hébergement</Link>
    <Link :href="route('experiences')" class="header-link-mobile">Expériences</Link>
    <Link :href="route('devenir-hote')" class="header-link-mobile">Devenir Hôte</Link>
    <Link :href="route('contact')" class="header-link-mobile">Contact</Link>
    <Link :href="route('blog')" class="header-link-mobile">Blog</Link>
    <div class="header-menu-mobile-actions">
      <Link v-if="user" :href="route('dashboard')" class="header-link-mobile-green">
        <VsxIcon iconName="Chart" size="25" color="#296242" type="linear" />
        Tableau de bord
      </Link>
      <Link v-if="user" method="post" :href="route('logout')" class="header-link-mobile-red"><LogOut class="sidebar-logout-icon" />Déconnexion</Link>
      <Link v-else :href="route('connexion')" class="header-link-mobile-green">Connexion / Inscription</Link>
    </div>
  </div>
</template>

<style scoped>
  .header-marging {
    margin-top: 100px;
  }

  .header {
    z-index: 9999;
    position: fixed;
    display: flex;
    justify-content: space-between;
    align-items: center;
    column-gap: 20px;
    width: 100%;
    height: 100px;
    padding: 10px 80px;
    background-color: #ffffff;
  }

  .header-logo-link {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  .header-logo {
    height: 100%;
  }

  .header-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
  }

  .header-link {
    color: #484848;
    text-decoration: none;
  }

  .header-menu-actions {
    display: flex;
    gap: 10px;
  }

  .header-responsive-button {
    position: relative;
    display: none;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 6px;
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .header-button {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    max-height: 100%;
    padding: 0 30px;
    border: 0;
    border-radius: 10px;
    background-color: #296242;
    color: #ffffff;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .header-button:hover {
    background-color: #357d54;
  }

  .header-button-logout, .header-button-dashboard {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    max-height: 100%;
    padding: 0 30px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }
  
  .header-button-logout {
    border: solid crimson 2px;
    background-color: #ffffff;
    color: crimson;
  }
  .header-button-logout:hover {
    color: #ffffff;
    background-color: crimson;
  }

  .header-button-dashboard {
    border: solid #296242 2px;
    background-color: #ffffff;
    color: #296242;
  }
  .header-button-dashboard:hover {
    color: #ffffff;
    background-color: #296242;
  }

  .header-responsive-button > div {
    width: 25px;
    height: 2px;
    background-color: #ffffff;
    transition: 0.25s;
  }

  .header-menu-mobile {
    z-index: 9999;
    top: 80px;
    position: fixed;
    display: none;
    flex-direction: column;
    gap: 5px;
    padding: 0;
    height: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    transition: 0.25s;
    overflow: hidden;
  }

  .header-menu-mobile-open {
    height: 100%;
    padding: 20px;
  }

  .header-link-mobile {
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    color: #ffffff;
    text-decoration: none;
  }

  .header-menu-mobile-actions {
    display: flex;
    flex-direction: column;
    margin-top: 30px;
    gap: 5px;
  }

  .header-link-mobile-green, .header-link-mobile-red {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    font-weight: bold;
    font-family: Calibri, sans-serif;
    background-color: transparent;
    border: 0;
    padding: 0;
    text-align: left;
    color: crimson;
    text-decoration: none;
    cursor: pointer;
  }
  .header-link-mobile-red { color: crimson; }
  .header-link-mobile-green { color: #296242; }

  .header-responsive-button-opened div:nth-child(1) {
    position: absolute;
    transform: rotate(45deg);
  }

  .header-responsive-button-opened div:nth-child(2) {
    position: absolute;
    display: none;
  }

  .header-responsive-button-opened div:nth-child(3) {
    position: absolute;
    transform: rotate(-45deg);
  }

  @media screen and (max-width: 1350px) {
    .header-nav {
      gap: 10px;
      font-size: 16px;
    }
  }

  @media screen and (max-width: 1200px) {
    .header {
      padding: 10px 40px;
    }

    .header-button {
      height: 50px;
      padding: 0 20px;
      font-size: 16px;
    }
  }

  @media screen and (max-width: 1050px) {
    .header-button-logout, .header-button-dashboard {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50px;
      max-height: 100%;
      padding: 0 10px;
      border-radius: 10px;
      text-decoration: none;
      font-size: 16px;
      font-weight: 400;
      font-family: Calibri, sans-serif;
      transition: 0.25s;
      cursor: pointer;
    }
  }

  @media screen and (max-width: 930px) {
    .header {
      height: 80px;
      padding: 10px 10px;
    }

    .header-nav {
      display: none;
    }

    .header-button, .header-button-logout, .header-button-dashboard {
      display: none;
    }

    .header-responsive-button {
      display: flex;
    }

    .header-menu-mobile {
      display: flex;
    }
  }
</style>
