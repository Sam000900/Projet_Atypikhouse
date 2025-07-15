<script setup>
  import { ref, computed  } from 'vue';
  import { Link, usePage } from '@inertiajs/vue3';
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
    <Link v-if="user" method="post" :href="route('logout')" class="header-button-logout" as="button">Déconnexion</Link>
    <Link v-else :href="route('connexion')" class="header-button" as="button">Connexion / Inscription</Link>
    <button class="header-responsive-button" @click="() => isMenuMobileOpen = !isMenuMobileOpen">
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
    <Link v-if="user" method="post" :href="route('logout')" class="header-link-mobile-red">Déconnexion</Link>
    <Link v-else :href="route('connexion')" class="header-link-mobile-green">Connexion / Inscription</Link>
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

  .header-responsive-button {
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

  .header-button-logout {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    max-height: 100%;
    padding: 0 30px;
    border: solid crimson 2px;
    border-radius: 10px;
    background-color: #ffffff;
    color: crimson;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .header-button-logout:hover {
    color: #ffffff;
    background-color: crimson;
  }

  .header-responsive-button > div {
    width: 90%;
    height: 2px;
    background-color: #ffffff;
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

  .header-link-mobile-green {
    margin-top: 30px;
    font-size: 20px;
    font-weight: bold;
    font-family: Calibri, sans-serif;
    color: #296242;
    text-decoration: none;
  }

  .header-link-mobile-red {
    margin-top: 30px;
    font-size: 20px;
    font-weight: bold;
    font-family: Calibri, sans-serif;
    color: crimson;
    text-decoration: none;
  }

  @media screen and (max-width: 1200px) {
    .header {
      padding: 10px 40px;
    }

    .header-nav {
      gap: 10px;
      font-size: 16px;
    }

    .header-button {
      height: 50px;
      padding: 0 20px;
      font-size: 16px;
    }
  }

  @media screen and (max-width: 860px) {
    .header {
      height: 80px;
      padding: 10px 10px;
    }

    .header-nav {
      display: none;
    }

    .header-button, .header-button-logout {
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
