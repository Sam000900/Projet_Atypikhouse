<script setup>
  import HousingGeneralsInfos from '@/components/medium/HousingGeneralsInfos.vue';
  import HousingMedia from '@/components/medium/HousingMedia.vue';
  import HousingEquipment from '@/components/medium/HousingEquipment.vue';
  import HousingPricing from '@/components/medium/HousingPricing.vue';
  import HousingAvailability from '@/components/medium/HousingAvailability.vue';
  import HousingRules from '@/components/medium/HousingRules.vue';
  import { useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';
  import { ref, watch, onMounted } from 'vue'
  import axios from 'axios';

  /* navigation */
  const navhousing = [
    { name: 'Informations générales', icon: 'House' },
    { name: 'Photos et médias', icon: 'PictureFrame' },
    { name: 'Equipements et services', icon: 'TableLamp' },
    { name: 'Tarification', icon: 'DollarCircle' },
    { name: 'Disponibilités', icon: 'CalendarSearch' },
    { name: 'Règles', icon: 'InfoCircle' },
  ];

  const normalizeTime = (time) => {
    if (!time) return '';
    return time.slice(0, 5);
  };


  const emit = defineEmits(['emitResetSelectedAccommodation']);
  const props = defineProps(['accommodationData']);
  const accommodationData = ref(props.accommodationData);
  const tabNumber = ref(0);
  const images = ref([]);
  const retrievedImages = ref([]);
  const form = useForm({
    ...{
      name: '',
      type: '',
      area: '',
      capacity: '',
      bedrooms: '',
      department: '',
      municipality: '',
      address: '',
      description: '',
      latitude: '',
      longitude: '',
      wifi: false,
      air_conditioning: false,
      parking: false,
      spa: false,
      equipped_kitchen: false,
      household_linen_provided: false,
      bathroom: false,
      price_night: '',
      min_number_nights: '',
      security_deposit: '',
      cleaning_charges: '',
      arrival_time: '',
      departure_time: '',
      smokers_allowed: false,
      pets_allowed: false,
      events_allowed: false,
      minimum_age: '',
      additional_rules: '',
      images: [],
    },
    ...(accommodationData.value ? {
      ...accommodationData.value,
      arrival_time: normalizeTime(accommodationData.value.arrival_time),
      departure_time: normalizeTime(accommodationData.value.departure_time),
    } : {})
  });

  watch(images, (newImages) => {
    form.images = newImages;
  });

  function tabChange(newValue) {
    tabNumber.value = newValue;
  }

  const getAccommodationImages = () => {
    axios
      .get(`/accommodation-images/${accommodationData.value.id}`)
      .then(response => (retrievedImages.value = response.data))
      .catch(error => console.log(error));
  };

  onMounted(() => {
    if (accommodationData.value) {
      getAccommodationImages();
    }
  });

  async function submit() {
    const isEdit = !!accommodationData.value?.id;
    const url = isEdit
      ? route('update-accommodation', accommodationData.value.id)
      : route('register-accommodation');

    const booleanFields = [
      'wifi', 'air_conditioning', 'parking', 'spa',
      'equipped_kitchen', 'household_linen_provided',
      'bathroom', 'smokers_allowed', 'pets_allowed', 'events_allowed'
    ];

    booleanFields.forEach(key => {
      form[key] = form[key] ? 1 : 0;
    });

    form.images = images.value.map(img => img.file);

    form.post(url, {
      preserveScroll: true,
      //onSuccess: () => console.log('Success!'),
      onError: errors => console.error('Errors:', errors)
    });
  }

</script>

<template>
  <div class="dashboardhousing">
    <div class="dashboardhousing-top">
      <button class="dashboardhousing-nav-button" v-for="(item, index) in navhousing" @click="tabChange(index)" :key="index">
        <VsxIcon :iconName="item.icon" color="#5D6679" size="25" type="linear" />
        {{ item.name }}
      </button>
    </div>

    <form @submit.prevent="submit" class="accommodation-rental-form" enctype="multipart/form-data">
      <div class="dashboardhousing-content">
        <div class="dashboardhousing-form">
          <HousingMedia v-if="tabNumber === 1" :formData="form" :storedImagesData="retrievedImages" v-model:images="images" />
          <HousingEquipment v-else-if="tabNumber === 2" :formData="form" />
          <HousingPricing v-else-if="tabNumber === 3" :formData="form" />
          <HousingAvailability v-else-if="tabNumber === 4" :formData="form" />
          <HousingRules v-else-if="tabNumber === 5" :formData="form" />
          <HousingGeneralsInfos v-else :formData="form" />
        </div>
      </div>

      <div class="dashboardhousing-bottom">
        <button type="button" class="dashboardhousing-button-cancel" :disabled="form.processing" @click="emit('emitResetSelectedAccommodation');">
          Annuler
        </button>
        <button type="submit" class="dashboardhousing-button-save" :disabled="form.processing">
          Enregistrer
          <LoaderCircle v-if="form.processing" class="dashboardhousing-form-loader" />
        </button>
      </div>
    </form>

  </div>
</template>

<style scoped>
  .dashboardhousing {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    border-radius: 16px;
    background-color: #ffffff;
  }

  .dashboardhousing-top {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    column-gap: 30px;
    row-gap: 10px;
    width: 100%;
    min-height: 80px;
    padding: 10px 20px;
    border-bottom: solid 1px #B9BDC7;
  }

  .dashboardhousing-nav-button {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: #5D6679;
    line-height: 100%;
    border: 0;
    background-color: transparent;
    cursor: pointer;
  }

  .accommodation-rental-form {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .dashboardhousing-content {
    flex: 1;
    display: flex;
    padding: 20px 40px;
  }

  .dashboardhousing-form{
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .dashboardhousing-bottom {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    width: 100%;
    min-height: 80px;
    padding: 10px 20px;
    border-top: solid 1px #B9BDC7;
  }

  .dashboardhousing-button-cancel {
    height: 50px;
    padding: 10px 20px;
    border: 0;
    border: solid 1px crimson;
    border-radius: 8px;
    background-color: transparent;
    color: crimson;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardhousing-button-cancel:hover {
    background-color: crimson;
    color: #ffffff;
  }

  .dashboardhousing-button-save {
    height: 50px;
    padding: 10px 20px;
    border: 0;
    border-radius: 8px;
    background-color: #296242;
    color: #ffffff;
    font-size: 20px;
    font-weight: 400;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .dashboardhousing-button-save:hover {
    background-color: #357d54;
  }


  .dashboardhousing-form-loader {
    animation: 0.5s linear infinite loader; 
  }

  @media screen and (max-width: 1200px) {
    .dashboardhousing-top {
      justify-content: flex-start;
    }
  }

  @media screen and (max-width: 800px) {
    .dashboardhousing-top {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media screen and (max-width: 500px) {
    .dashboardhousing-content {
      padding: 15px;
    }

    .dashboardhousing-bottom {
      flex-wrap: wrap;
    }
  }
</style>