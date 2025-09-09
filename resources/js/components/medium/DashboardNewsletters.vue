<script setup>
  import { onMounted, ref } from 'vue';
  import { getLastFiftyNewsletters } from "@/api/newsletterApi.js";

  const newsletters = ref([]);
  const currentPage = ref(1);
  const totalPages = ref(1);

  async function loadNewsletters(page = 1) {
    const response = await getLastFiftyNewsletters(page);
    newsletters.value = response.data;
    totalPages.value = response.last_page || 1;
    currentPage.value = response.current_page || 1;
  }

  function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
      loadNewsletters(page);
    }
  }

  onMounted(() => {
    loadNewsletters(1);
  });
</script>

<template>
  <div class="dashboardnewsletters">
    <h2>Newsletters et Campagne de communication</h2>
    <h3>Abonnés</h3>

    <div v-if="newsletters.length !== 0" class="dashboardnewsletters-table-box">
      <table>
        <tr>
          <th class="dashboardnewsletters-table-id"><b>Id</b></th>
          <th><b>Email</b></th>
        </tr>
        <tr
          v-for="(newsletter, index) in newsletters"
          :key="index"
        >
          <td class="dashboardnewsletters-table-id">{{ newsletter.id }}</td>
          <td>{{ newsletter.email }}</td>
        </tr>
      </table>
    </div>

    <div v-else>
      <p>Aucun abonné à la newsletter</p>
    </div>

    <div v-if="newsletters.length !== 0"  class="dashboardnewsletters-pagination">
      <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Précédent</button>
      <div class="dashboardnewsletters-pagination-page"><p>Page {{ currentPage }} / {{ totalPages }}</p></div>
      <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Suivant</button>
    </div>

    <h3>Campagne de communication</h3>
    <p>En cours de développement...</p>
  </div>
</template>

<style scoped>
  h3 {
    margin: 30px 0 20px 0;
  }

  .dashboardnewsletters {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    margin-top: 10px;
    padding: 40px;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardnewsletters-table-box {
    overflow-y: auto;
  }

  table {
    width: 100%;
    margin: 0 0 30px 0;
    background-color: black;
    table-layout: fixed;
    min-width: 700px;
  }

  td, th {
    padding: 5px 10px;
    background-color: #ffffff;
    overflow-y: auto;
    word-break: break-word;
    text-align: start;
  }

  tr td:first-child {
    width: 350px;
  }

  .dashboardnewsletters-table-id {
    width: 80px;
  }

  .dashboardnewsletters-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
  }

  .dashboardnewsletters-pagination button {
    display: flex;
    justify-content: center;
    align-items: center;
    max-height: 100%;
    padding: 10px 10px;
    border: 0;
    border-radius: 5px;
    background-color: #296242;
    color: #ffffff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    transition: 0.25s;
    cursor: pointer;
  }

  .dashboardnewsletters-pagination button:hover {
    background-color: #357d54;
  }

  .dashboardnewsletters-pagination button:disabled {
    background-color: #5D6679;
  }

  .dashboardnewsletters-pagination-page {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 10px;
    border-radius: 5px;
    border: solid #296242 1px;
  }
</style>