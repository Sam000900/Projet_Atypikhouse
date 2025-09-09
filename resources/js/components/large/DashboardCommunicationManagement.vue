<script setup>
  import { ref } from 'vue';
  import DashboardContacts from '@/components/medium/DashboardContacts.vue';
  import DashboardNewsletters from '@/components/medium/DashboardNewsletters.vue';

  const tabs = [
    { key: 'contacts', label: 'Contacts' },
    { key: 'newsletters', label: 'Newsletters' },
  ];
  const selectedTab = ref(tabs[0].key);

  function switchTab(tabKey) {
    selectedTab.value = tabKey;
  }
</script>

<template>
  <div class="dashboardcommunicationmanagement">
    <div class="dashboardcommunicationmanagement-nav">
      <button
        v-for="tab in tabs"
        :key="tab.key"
        @click="switchTab(tab.key)"
        class="dashboardcommunicationmanagement-nav-button"
        :class="{ 'dashboardcommunicationmanagement-nav-button-active': selectedTab === tab.key }"
        type="button"
      >
        {{ tab.label }}
      </button>
    </div>

    <section v-if="selectedTab === 'contact'" class="dashboardnewsletter">
      <h2>Contact</h2>
    </section>

    <DashboardContacts v-else-if="selectedTab === 'contacts'" />
    <DashboardNewsletters v-else-if="selectedTab === 'newsletters'" />
  </div>
</template>

<style scoped>
  .dashboardcommunicationmanagement {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .dashboardcommunicationmanagement-nav {
    display: flex;
    width: fit-content;
    gap: 10px;
  }

  .dashboardcommunicationmanagement-nav-button {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    padding: 10px;
    border: solid #ffffff 1px;
    background-color: #ffffff;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardcommunicationmanagement-nav-button:hover {
    border-color: #357d54;
  }

  .dashboardcommunicationmanagement-nav-button-active {
    border-color: #296242;
    background-color: #296242;
    color: #ffffff;
  }

  /* ----- */

  .dashboardnewsletter {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    margin-top: 10px;
    padding: 40px;
    border-radius: 24px;
    background-color: #ffffff;
  }
</style>