<script setup>
  import { ref, onMounted } from 'vue';
  import { router } from '@inertiajs/vue3';
  import axios from 'axios';
  import DashboardHousingCard from '@/components/medium/DashboardHousingCard.vue';
  import DashboardHousing from '@/components/medium/DashboardHousing.vue';

  const onManagementPage = ref(true)
  const userAccommodations = ref([]);
  const selectedAccommodation = ref(undefined);
  const getUserAccommodations = () => {
    axios
      .get('/user-accommodations')
      .then(response => ( userAccommodations.value = response.data ))
      .catch((error) => console.log(error));
  }

  const switchToManagementPage = () => {
    onManagementPage.value = false;
  }

  const modifyAccommodation = (accommodationId) => {
    selectedAccommodation.value = userAccommodations.value.find(accommodation => accommodation.id === accommodationId);
    onManagementPage.value = false;
  }

  async function deleteAccommodation(accommodationId) {
    if (!confirm("Voulez-vous vraiment supprimer ce logement ?")) return;
    router.delete(route('delete-accommodation', accommodationId), {
      onSuccess: () => { getUserAccommodations(); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  const resetSelectedAccommodation = () => {
    onManagementPage.value = true;
    selectedAccommodation.value = undefined;
  };

  onMounted(() => {
    getUserAccommodations();
  });
</script>

<template>
  <div class="dashboardhousingmanagement">
    <template v-if="onManagementPage">
      <div class="dashboardhousingmanagement-button-box">
        <button class="dashboardhousingmanagement-button" @click="switchToManagementPage">Ajouter un logement</button>
      </div>
      <div class="dashboardhousingmanagement-main" :style="{ justifyContent: userAccommodations.length <= 0 ? 'center' : 'start' }">
        <p class="dashboardhousingmanagement-text" v-if="userAccommodations.length <= 0">Aucun logement n'a été enregistré pour le moment !</p>
        <template v-else v-for="accommodation in userAccommodations" :key="accommodation.id">
          <DashboardHousingCard
            :accommodationInfo="accommodation"
            @emitModifyAccommodation="modifyAccommodation"
            @emitDeleteAccommodation="deleteAccommodation"
          />
        </template>
      </div>
    </template>
    <template v-else>
      <DashboardHousing :accommodationData="selectedAccommodation" @emitResetSelectedAccommodation="resetSelectedAccommodation" />
    </template>
  </div>
</template>

<style scoped>
  .dashboardhousingmanagement {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 20px;
  }

  .dashboardhousingmanagement-button-box {
    display: flex;
    justify-content: flex-end;
  }

  .dashboardhousingmanagement-button {
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

  .dashboardhousingmanagement-button:hover {
    background-color: #357d54;
  }

  .dashboardhousingmanagement-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
  }

  .dashboardhousingmanagement-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
  }
</style>