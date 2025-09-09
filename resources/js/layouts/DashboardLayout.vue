<script setup>
  import { ref, onMounted } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import SidebarLayout from '@/layouts/SidebarLayout.vue';
  import Loader from '@/components/small/Loader.vue';
  import { getLoggedUser } from '@/api/userApi.js';
  
  const userInfo = ref(null);
  const props = defineProps(['pageData']);

  async function loadLoggedUser() {
    const response = await getLoggedUser();
    userInfo.value = response.data;
  }

  onMounted(() => {
    loadLoggedUser();
  });
</script>

<template>
  <div class="dashboardlayout">
    <SidebarLayout />
    <div class="dashboardlayout-content">
      <div class="dashboardlayout-header">
        <h1 class="dashboardlayout-title">{{ props.pageData.title }}</h1>
        <div class="dashboardlayout-info-profil-box">
          <VsxIcon iconName="Notification" size="30" color="#5D6679" type="linear" />
          <div v-if="userInfo && userInfo.image_path" class="dashboardlayout-profil-image-box">
            <Link :href="route('dashboard/parametres')" class="dashboardlayout-profil-link">
              <img :src="'/' + userInfo.image_path" alt="Image de l'utilisateur" class="dashboardlayout-image"/>
            </Link>
          </div>
          <Loader v-else />
        </div>
      </div>
      <div class="dashboardlayout-main">
        <slot />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .dashboardlayout {
    display: flex;
    height: 100vh;
    background-color: #e2e2e2;
  }

  .dashboardlayout-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
  }

  .dashboardlayout-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    width: 100%;
    margin-bottom: 60px;
    padding: 30px 30px 0 30px;
  }

  .dashboardlayout-title {
    font-family: Calibri, sans-serif;
    font-size: 48px;
    font-weight: bold;
    color: #000000;
    line-height: 100%;
  }

  .dashboardlayout-info-profil-box {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
  }

  .dashboardlayout-profil-image-box {
    width: 45px;
    height: 45px;
    border-radius: 35px;
    background-color: #747474;
  }

  .dashboardlayout-profil-link {
    width: 100%;
    height: 100%;
    border-radius: inherit;
  }

  .dashboardlayout-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }

  .dashboardlayout-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 0 30px 30px 30px;
  }

  @media screen and (max-width: 1000px) {
    .dashboardlayout-content {
      padding-left: 50px;
    }

    .dashboardlayout-title {
      font-size: 36px;
    }
  }

  @media screen and (max-width: 600px) {
    .dashboardlayout-header {
      flex-direction: column-reverse;
      align-items: flex-start;
      padding: 30px 10px 0 10px;
    }

    .dashboardlayout-info-profil-box {
      flex-direction: row-reverse;
    }

    .dashboardlayout-main {
      flex: 1;
      display: flex;
      flex-direction: column;
      width: 100%;
      padding: 0 10px 30px 10px;
    }
  }
</style>
