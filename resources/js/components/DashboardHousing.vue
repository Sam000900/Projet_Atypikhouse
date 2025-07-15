<script setup>
  import HousingGeneralsInfos from '@/components/parts/HousingGeneralsInfos.vue';
  import HousingMedia from '@/components/parts/HousingMedia.vue';
  import HousingEquipment from '@/components/parts/HousingEquipment.vue';
  import HousingPricing from '@/components/parts/HousingPricing.vue';
  import HousingAvailability from '@/components/parts/HousingAvailability.vue';
  import HousingRules from '@/components/parts/HousingRules.vue';
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
  ]

  const emit = defineEmits(['emitResetSelectedAccommodation']);
  const props = defineProps(['accommodationData']);
  const accommodationData = ref(props.accommodationData);

  const tabNumber = ref(0);
  const images = ref([]);
  watch(images, (newImages) => {
    form.images = newImages;
  });

  function tabChange(newValue) {
    tabNumber.value = newValue;
  }

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
    ...(accommodationData.value ?? {})
  });

  const retrievedImages = ref([]);

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
    const formData = new FormData();

    const booleanFields = [
      'wifi',
      'air_conditioning',
      'parking',
      'spa',
      'equipped_kitchen',
      'household_linen_provided',
      'bathroom',
      'smokers_allowed',
      'pets_allowed',
      'events_allowed'
    ];

    for (const key in form) {
      if (Object.prototype.hasOwnProperty.call(form, key)) {
        const value = form[key];

        if (booleanFields.includes(key)) {
          // Laravel expects 1 or 0 for booleans via multipart/form-data
          formData.append(key, value ? 1 : 0);
        } else if (typeof value === 'string' || typeof value === 'number') {
          formData.append(key, value);
        } else if (Array.isArray(value) && key !== 'images') {
          value.forEach((item, index) => {
            formData.append(`${key}[${index}]`, item);
          });
        }
      }
    }

    images.value.forEach((img, index) => {
      if (img.file instanceof File) {
        formData.append('images[]', img.file);
      }
    });

    if (accommodationData.value?.id) {
      form.submit('post', route('update-accommodation', accommodationData.value.id), {
        data: formData,
        forceFormData: true,
        onSuccess: () => console.log("Success!"),
        onError: (errors) => console.error("Errors:", errors),
        onFinish: () => console.log("Finished."),
      });
    }

    else {
      //console.log(formData.get('images[]'));
      /*
        form.post('/register-accommodation', {
          data: formData,
          forceFormData: true,
          onSuccess: () => console.log("Success!"),
          onError: (errors) => console.error("Errors:", errors),
          onFinish: () => console.log("Finished."),
        });
      */
      for (let [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
      }

      try {
        const response = await axios.post('/register-accommodation', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        alert(response.data.message);
      }
      catch (error) {
        console.error("Error:", error);
      }
    }
  };

</script>

<template>
  <div class="dashboardhousing">
    <div class="dashboardhousing-top">
      <button
        class="dashboardhousing-nav-button"
        v-for="(item, index) in navhousing"
        @click="tabChange(index)"
        :key="item.name"
      >
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
    gap: 30px;
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
</style>