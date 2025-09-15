<script setup>
  import { ref } from 'vue';
  import { router } from '@inertiajs/vue3';
  import { getLastHundredUsers } from '@/api/userApi';
  import { getLastHundredAccommodations } from '@/api/accommodationApi';
  import { getLastHundredExperiences } from '@/api/experienceApi';
  import { getLastHundredArticles } from '@/api/articleApi';
  import DataTable from '@/components/medium/DataTable.vue';

  const activeTab = ref('');
  const users = ref([]);
  const accommodations = ref([]);
  const experiences = ref([]);
  const articles = ref([]);
  const isShown = ref(false);
  const selectedItem = ref(null);
  const configs = {
    users: {
      title: "Utilisateurs",
      thead: ["Id", "Email", "Prénom", "Nom", "Rôle", "Actions"],
      empty: "Aucun utilisateur trouvé"
    },
    accommodations: {
      title: "Logements",
      thead: ["Id", "Titre", "Actions"],
      empty: "Aucun logement trouvé"
    },
    experiences: {
      title: "Expériences",
      thead: ["Id", "Titre", "Actions"],
      empty: "Aucune expérience trouvé"
    },
    articles: {
      title: "Articles",
      thead: ["Id", "Titre", "Actions"],
      empty: "Aucun article trouvé"
    }
  };

  async function loadUsers() {
    const response = await getLastHundredUsers(1);
    users.value = response.data.data;
  };

  async function loadAccommodations() {
    const response = await getLastHundredAccommodations(1);
    accommodations.value = response.data;
  };

  async function loadExperiences() {
    const response = await getLastHundredExperiences(1);
    experiences.value = response.data;
  };

  async function loadArticles() {
    const response = await getLastHundredArticles(1);
    articles.value = response.data;
  };

  function selectTab(tabKey) {
    activeTab.value = tabKey;
    if (tabKey === 'users' && users.value.length === 0) {
      loadUsers();
    }
    else if (tabKey === 'accommodations' && accommodations.value.length === 0) {
      loadAccommodations();
    }
    else if (tabKey === 'experiences' && experiences.value.length === 0) {
      loadExperiences();
    }
    else if (tabKey === 'articles' && articles.value.length === 0) {
      loadArticles();
    }
  }

  function goBack() {
    activeTab.value = '';
    isShown.value = false;
    selectedItem.value = null;
  }

  function showItemData(item) {
    selectedItem.value = item;
    isShown.value = true;
  }

  function closeItemData() {
    isShown.value = false;
    selectedItem.value = null;
  }

  function deleteUser(user, index) {
    if (!confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) return;
    router.delete(route('delete-user', user.id), {
      onSuccess: () => { users.value.splice(index, 1); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  function deleteAccommodation(accommodation, index) {
    if (!confirm("Voulez-vous vraiment supprimer ce logement ?")) return;
    router.delete(route('delete-accommodation', accommodation.id), {
      onSuccess: () => { accommodations.value.splice(index, 1); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  function deleteExperience(experience, index) {
    if (!confirm("Voulez-vous vraiment supprimer cette expérience ?")) return;
    router.delete(route('delete-experience', experience.id), {
      onSuccess: () => { experiences.value.splice(index, 1); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  function deleteArticle(article, index) {
    if (!confirm("Voulez-vous vraiment supprimer cet article ?")) return;
    router.delete(route('delete-article', article.id), {
      onSuccess: () => { articles.value.splice(index, 1); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }
</script>

<template>
  <div class="dashboarddata">

    <div v-if="!activeTab" class="dashboarddata-data-selection">
      <div v-for="(tab , index) in Object.keys(configs)" :key="index" class="dashboarddata-tab" @click="selectTab(tab)">
        <p>Gestions des {{ configs[tab].title }}</p>
        <div class="dashboarddata-goto">
          <VsxIcon iconName="ArrowRight2" :size="25" color="#ffffff" type="linear" />
        </div>
      </div>
    </div>

    <DataTable
      v-else-if="activeTab === 'articles'"
      :config="configs.articles"
      :data="articles"
      :is-shown="isShown"
      :selected-item="selectedItem"
      @go-back="goBack"
      @show-item="showItemData"
      @delete-item="deleteArticle"
      @close-item="closeItemData"
    />

    <DataTable
      v-else-if="activeTab === 'accommodations'"
      :config="configs.accommodations"
      :data="accommodations"
      :is-shown="isShown"
      :selected-item="selectedItem"
      @go-back="goBack"
      @show-item="showItemData"
      @delete-item="deleteAccommodation"
      @close-item="closeItemData"
    />

    <DataTable
      v-else-if="activeTab === 'experiences'"
      :config="configs.experiences"
      :data="experiences"
      :is-shown="isShown"
      :selected-item="selectedItem"
      @go-back="goBack"
      @show-item="showItemData"
      @delete-item="deleteExperience"
      @close-item="closeItemData"
    />

    <DataTable
      v-else-if="activeTab === 'users'"
      :config="configs.users"
      :data="users"
      :is-shown="isShown"
      :selected-item="selectedItem"
      @go-back="goBack"
      @show-item="showItemData"
      @delete-item="deleteUser"
      @close-item="closeItemData"
    />
  </div>
</template>

<style scoped>
  .dashboarddata {
    display: flex;
    flex-direction: column;
  }

  .dashboarddata-data-selection {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .dashboarddata-tab {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 60px;
    width: 100%;
    border-radius: 60px;
    padding: 0 5px 0 30px;
    background-color: #ffffff;
    cursor: pointer;
  }

  .dashboarddata-goto {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    border-radius: 40px;
    background-color: #296242;
    transition: 0.25s;
  }

  .dashboarddata-tab:hover .dashboarddata-goto {
    background-color: #357d54;
  }
</style>