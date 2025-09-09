<script setup>
  import { ref, onMounted } from 'vue';
  import { router } from '@inertiajs/vue3';
  import { getLastTenExperiences } from '@/api/experienceApi.js';
  import DashboardExperienceCard from '@/components/medium/DashboardExperienceCard.vue';
  import DashboardExperiences from '@/components/medium/DashboardExperiences.vue';

  const onManagementPage = ref(true)
  const experiences = ref([]);
  const selectedExperience = ref(undefined);

  async function loadTenExperiences() {
    const response = await getLastTenExperiences();
    experiences.value = response.data;
  };

  function switchToManagementPage() {
    onManagementPage.value = false;
  }

  function modifyExperience(experienceId) {
    selectedExperience.value = experiences.value.find(experience => experience.id === experienceId);
    onManagementPage.value = false;
  }

  async function deleteExperience(ExperienceId) {
    if (!confirm("Voulez-vous vraiment supprimer cette expérience ?")) return;
    router.delete(route('delete-experience', ExperienceId), {
      onSuccess: () => { loadTenExperiences(); },
      onError: (errors) => { console.error('Erreur lors de la suppression:', errors); }
    });
  }

  function resetSelectedExperience() {
    onManagementPage.value = true;
    selectedExperience.value = undefined;
  };

  function handleExperienceUpdated() {
    loadTenExperiences();
    resetSelectedExperience();
  }

  onMounted(() => {
    loadTenExperiences();
  });
</script>

<template>
  <div class="dashboardexperiencesmanagement">
    <template v-if="onManagementPage">
      <div class="dashboardexperiencesmanagement-button-box">
        <button class="dashboardexperiencesmanagement-button" @click="switchToManagementPage">Ajouter une Expérience</button>
      </div>
      <div class="dashboardexperiencesmanagement-main" :style="{ justifyContent: experiences.length <= 0 ? 'center' : 'start' }">
        <p class="dashboardexperiencesmanagement-text" v-if="experiences.length <= 0">Aucune expérience n'a été enregistrée pour le moment !</p>
        <template v-else v-for="experience in experiences" :key="experience.id">
          <DashboardExperienceCard
            :experienceInfo="experience"
            @emitModifyExperience="modifyExperience"
            @emitDeleteExperience="deleteExperience"
          />
        </template>
      </div>
    </template>
    <template v-else>
      <DashboardExperiences
        :experienceData="selectedExperience"
        @emitResetSelectedExperience="resetSelectedExperience"
        @experienceUpdated="handleExperienceUpdated"
      />
    </template>
  </div>
</template>

<style scoped>
  .dashboardexperiencesmanagement {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 20px;
  }

  .dashboardexperiencesmanagement-button-box {
    display: flex;
    justify-content: flex-end;
  }

  .dashboardexperiencesmanagement-button {
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

  .dashboardexperiencesmanagement-button:hover {
    background-color: #357d54;
  }

  .dashboardexperiencesmanagement-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
  }

  .dashboardexperiencesmanagement-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
  }
</style>