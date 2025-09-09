<script setup>
  import { ref, onMounted } from 'vue';
  import { router } from '@inertiajs/vue3';
  import { getAllArticles } from '@/api/articleApi';
  import DashboardArticleCard from '@/components/medium/DashboardArticleCard.vue';
  import DashboardArticles from '@/components/medium/DashboardArticles.vue';

  const onManagementPage = ref(true)
  const articles = ref([]);
  const selectedArticle = ref(undefined);

  async function loadAllArticles() {
    articles.value = await getAllArticles();
  };

  const switchToManagementPage = () => {
    onManagementPage.value = false;
  }

  const modifyArticle = (articleId) => {
    selectedArticle.value = articles.value.find(article => article.id === articleId);
    onManagementPage.value = false;
  }

  async function deleteArticle(articleId) {
    if (!confirm("Voulez-vous vraiment supprimer cet article ?")) return;
    router.delete(route('delete-article', articleId), {
      onSuccess: () => { loadAllArticles(); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  const resetSelectedArticle = () => {
    onManagementPage.value = true;
    selectedArticle.value = undefined;
  };

  function handleArticleUpdated() {
    loadAllArticles();
    resetSelectedArticle();
  }

  onMounted(() => {
    loadAllArticles();
  });
</script>

<template>
  <div class="dashboardarticlesmanagement">
    <template v-if="onManagementPage">
      <div class="dashboardarticlesmanagement-button-box">
        <button class="dashboardarticlesmanagement-button" @click="switchToManagementPage">Ajouter un article</button>
      </div>
      <div class="dashboardarticlesmanagement-main" :style="{ justifyContent: articles.length <= 0 ? 'center' : 'start' }">
        <p class="dashboardarticlesmanagement-text" v-if="articles.length <= 0">Aucun article n'a été enregistré pour le moment !</p>
        <template v-else v-for="article in articles" :key="article.id">
          <DashboardArticleCard
            :articleInfo="article"
            @emitModifyArticle="modifyArticle"
            @emitDeleteArticle="deleteArticle"
          />
        </template>
      </div>
    </template>
    <template v-else>
      <DashboardArticles
        :articleData="selectedArticle"
        @emitResetSelectedArticle="resetSelectedArticle"
        @articleUpdated="handleArticleUpdated"
      />
    </template>
  </div>
</template>

<style scoped>
  .dashboardarticlesmanagement {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 20px;
  }

  .dashboardarticlesmanagement-button-box {
    display: flex;
    justify-content: flex-end;
  }

  .dashboardarticlesmanagement-button {
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

  .dashboardarticlesmanagement-button:hover {
    background-color: #357d54;
  }

  .dashboardarticlesmanagement-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
  }

  .dashboardarticlesmanagement-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
  }
</style>