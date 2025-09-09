<script setup>
  import { onMounted, ref } from 'vue';
  import { getLastFiftyContacts, markContactAsRead, markContactAsUnread } from "@/api/contactApi.js";

  const contacts = ref([]);
  const currentPage = ref(1);
  const totalPages = ref(1);
  const isShown = ref(false);
  const selectedItem = ref(null);

  async function loadContacts(page = 1) {
    const response = await getLastFiftyContacts(page);
    contacts.value = response.data;
    totalPages.value = response.last_page || 1;
    currentPage.value = response.current_page || 1;
  }

  function readableStatus(status) {
    return status ? "Lu" : "Non lu";
  }

  function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
      loadContacts(page);
    }
  }

  function showItemData(item) {
    selectedItem.value = item;
    isShown.value = true;
  }

  function closeItemData() {
    isShown.value = false;
    selectedItem.value = null;
  }

  async function markAsRead(contact) {
    const response = await markContactAsRead(contact.id);
    Object.assign(contact, response);
    if (selectedItem.value?.id === contact.id) {
      Object.assign(selectedItem.value, response);
    }
  }

  async function markAsUnread(contact) {
    const response = await markContactAsUnread(contact.id);
    Object.assign(contact, response);
    if (selectedItem.value?.id === contact.id) {
      Object.assign(selectedItem.value, response);
    }
  }

  onMounted(() => {
    loadContacts(1);
  });
</script>

<template>
  <div class="dashboardcontacts">
    <div class="dashboardcontacts-top">
      <h2>Demandes de contacts</h2>
      <button v-if="isShown" class="dashboardcontacts-button-previous" @click="closeItemData">Retour</button>
    </div>

    <div v-if="!isShown">
      <h3>Messages</h3>

      <div v-if="contacts.length !== 0" class="dashboardcontacts-table-box">
        <table>
          <tr>
            <th class="dashboardcontacts-table-id"><b>Id</b></th>
            <th><b>Email</b></th>
            <th class="dashboardcontacts-table-status"><b>Statut</b></th>
            <th class="dashboardcontacts-table-action-th"><b>Action</b></th>
          </tr>
          <tr
            v-for="(contact, index) in contacts"
            :key="index"
          >
            <td class="dashboardcontacts-table-id">{{ contact.id }}</td>
            <td>{{ contact.email }}</td>
            <td
              class="dashboardcontacts-table-status"
              :class="contact.is_read ? 'dashboardcontacts-status-true' : 'dashboardcontacts-status-false'"
            >
              {{ readableStatus(contact.is_read) }}
            </td>
            <td class="dashboardcontacts-table-action">
              <button class="dashboardcontacts-button" @click="showItemData(contact)">Voir</button>
            </td>
          </tr>
        </table>
      </div>

      <div v-else>
        <p>Aucun message</p>
      </div>

      <div v-if="contacts.length !== 0" class="dashboardcontacts-pagination">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Précédent</button>
        <div class="dashboardcontacts-pagination-page"><p>Page {{ currentPage }} / {{ totalPages }}</p></div>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">Suivant</button>
      </div>
    </div>

    <div v-else>
      <h3>Message de {{ selectedItem.email }}</h3>
      <div class="dashboardcontacts-message-status-box">
        <div
          class="dashboardcontacts-message-status"
          :class="selectedItem.is_read ? 'dashboardcontacts-message-status-read' : 'dashboardcontacts-message-status-unread'"
        >
          <p>Message {{ selectedItem.is_read ? 'lu' : 'non lu' }}</p>
        </div>
        <button 
          v-if="!selectedItem.is_read" 
          class="dashboardcontacts-button-read-state" 
          @click="markAsRead(selectedItem)">
          Marquer comme lu
        </button>
        <button 
          v-if="selectedItem.is_read" 
          class="dashboardcontacts-button-read-state" 
          @click="markAsUnread(selectedItem)">
          Marquer comme non lu
        </button>
      </div>
      <p><b>Email :</b> {{ selectedItem.email }}</p>
      <p><b>Prénom :</b> {{ selectedItem.firstname }}</p>
      <p><b>Nom :</b> {{ selectedItem.lastname }}</p>
      <p><b>Téléphone :</b> {{ selectedItem.phone }}</p>
      <p><b>Message :</b> {{ selectedItem.message }}</p>
    </div>
  </div>
</template>

<style scoped>
  h3 {
    margin: 30px 0 20px 0;
  }

  .dashboardcontacts {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    margin-top: 10px;
    padding: 40px;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardcontacts-top {
    display: flex;
    justify-content: space-between;
  }

  .dashboardcontacts-button-previous {
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

  .dashboardcontacts-button-previous:hover {
      background-color: #357d54;
  }

  .dashboardcontacts-table-box {
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

  .dashboardcontacts-table-id { width: 80px; }
  .dashboardcontacts-table-status { width: 80px; }
  .dashboardcontacts-table-action {
    padding: 0;
    width: 150px;
  }
  .dashboardcontacts-table-action-th { width: 150px; }

  .dashboardcontacts-button {
    flex: 1;
    height: 100%;
    width: 100%;
    border: 0;
    padding: 6px 0;
    cursor: pointer;
    transition: 0.25s;
    background-color: orange;
  }

  .dashboardcontacts-button:hover {
    background-color: rgb(255, 211, 129);
  }

  .dashboardcontacts-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
  }

  .dashboardcontacts-pagination button {
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

  .dashboardcontacts-pagination button:hover {
    background-color: #357d54;
  }

  .dashboardcontacts-pagination button:disabled {
    background-color: #5D6679;
  }

  .dashboardcontacts-pagination-page {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 10px;
    border-radius: 5px;
    border: solid #296242 1px;
  }

  .dashboardcontacts-status-true {
    background-color: #d6d6d6;
  }

  .dashboardcontacts-status-false {
    background-color: #71ffaf;
  }

  .dashboardcontacts-message-status-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }

  .dashboardcontacts-message-status {
    display: flex;
    justify-content: center;
    align-items: center;
    width: fit-content;
    padding: 10px 10px;
    border-radius: 5px;
  }

  .dashboardcontacts-message-status-read { background-color: #d6d6d6; }
  .dashboardcontacts-message-status-unread { background-color: #71ffaf; }

  .dashboardcontacts-button-read-state {
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
</style>