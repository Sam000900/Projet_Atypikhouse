<script setup>
  import { ref, watch } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import { LoaderCircle } from 'lucide-vue-next';

  const props = defineProps(['reservationsData']);
  const todayDate = new Date().toISOString().substring(0, 10);
  const arrivalDate = ref(new Date().toISOString().substring(0, 10));
  const departureDate = ref(new Date().toISOString().substring(0, 10));
  const totalPrice = ref();
  const numberOfNights = ref();
  const error = ref();

  const masks = ref({ modelValue: 'YYYY-MM-DD' });
  const attrs = ref([
    { key: 'today', dot: 'orange', dates: new Date() },
    { key: 'not-available', highlight: 'red', content: true, dates: [] },
  ]);

  const form = useForm({
    accommodation_id: props.reservationsData.accommodation_id,
    arrival_date: arrivalDate.value,
    departure_date: departureDate.value,
    price_paid: totalPrice.value,
  });

  const submit = () => {
    error.value = null;

    if (arrivalDate.value >= departureDate.value) {
      error.value = "Erreur: Date d'arrivée supérieur ou égale à la date de départ";
      return;
    }

    if (todayDate > arrivalDate.value || todayDate > departureDate.value ) {
      error.value = "Erreur: Vous ne pouvez pas sélectionner une date antérieure à la date d'aujourd'hui";
      return;
    }

    form.post(route('book-accommodation'), {
      onSuccess: () => {
        error.value = null;
      }
    });
  };

  function getDateRange(startDate, endDate) {
    const dateArray = [];
    const current = new Date(startDate);

    while (current <= endDate) {
      dateArray.push(new Date(current));
      current.setDate(current.getDate() + 1);
    }

    return dateArray;
  }

  function calculateTotalPriceAndNumberOfNights() {
    const arrival = new Date(arrivalDate.value);
    const departure = new Date(departureDate.value);

    const diffTime = departure.getTime() - arrival.getTime();
    const nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (nights > 0) {
      totalPrice.value = nights * props.reservationsData.accommodation_price_night;
      numberOfNights.value = nights;
      form.price_paid = totalPrice.value;
    } else {
      numberOfNights.value = 0;
      totalPrice.value = 0;
      form.price_paid = 0;
    }
  }

  watch(arrivalDate, (newVal) => {
    form.arrival_date = newVal;
    calculateTotalPriceAndNumberOfNights();
  });

  watch(departureDate, (newVal) => {
    form.departure_date = newVal;
    calculateTotalPriceAndNumberOfNights();
  });

  watch(
    () => props.reservationsData.reservations?.value,
    (newReservations) => {
      const notAvailableAttr = attrs.value.find(attr => attr.key === 'not-available');
      if (!notAvailableAttr || !newReservations) return;

      notAvailableAttr.dates = [];
      form.accommodation_id = props.reservationsData.accommodation_id;

      for (const [key, reservation] of Object.entries(newReservations)) {
        const [ay, am, ad] = reservation.arrival_date.split("-");
        const [dy, dm, dd] = reservation.departure_date.split("-");

        const arrival = new Date(+ay, +am - 1, +ad);
        const departure = new Date(+dy, +dm - 1, +dd);

        const range = getDateRange(arrival, departure);

        range.forEach(date => {
          if (!notAvailableAttr.dates.some(d => d.getTime() === date.getTime())) {
            notAvailableAttr.dates.push(date);
          }
        });
      };
    },
    { immediate: true }
  );
</script>

<template>
  <div class="reservation layout-container">
    <div class="reservation-left-box">
      <h2 class="reservation-title">Tarifs & Réservation</h2>
      <div class="reservation-calendars-box">
        <div class="reservation-calendar-box">
          <p class="reservation-text">Date d'arrivée</p>
          <VDatePicker
            v-model.string="arrivalDate"
            :masks="masks"
            mode="date"
            expanded
            :attributes='attrs'
          />
        </div>
        <div class="reservation-calendar-box">
          <p class="reservation-text">Date de départ</p>
          <VDatePicker
            v-model.string="departureDate"
            :masks="masks"
            mode="date"
            expanded
            :attributes='attrs'
          />
        </div>
      </div>
    </div>
    <div class="reservation-right-box">
      <div class="reservation-info-box">
        <h3 class="reservation-sub-title">A partir de {{ props.reservationsData.accommodation_price_night }} € / nuit</h3>

        <p class="reservation-text-info">Nombre de nuits: {{ numberOfNights ? numberOfNights + '' : '0' }}</p>
        <p class="reservation-text-info">Total à payer: {{ totalPrice ? totalPrice + ' €' : '—' }}</p>

        <form @submit.prevent="submit">
          <div class="reservation-dates-inputs-box">
            <div class="reservation-arrival-box">
              <label for="arrival" class="reservation-label">Arrivée</label>
              <input
                id="arrival"
                type="date"
                class="reservation-input-date"
                required
                autofocus
                :tabindex="1"
                autocomplete="arrival"
                v-model="arrivalDate"
              />
            </div>
            <div class="reservation-departure-box">
              <label for="departure" class="reservation-label">Départ</label>
              <input
                id="departure"
                type="date"
                class="reservation-input-date"
                required
                autofocus
                :tabindex="2"
                autocomplete="departure"
                v-model="departureDate"
              />
            </div>
          </div>
        </form>

        <div class="reservation-errors-box">
          <p v-if="error" class="reservation-error-text">{{ error }}</p>
        </div>

        <div class="reservation-button-box">
          <button
            type="submit"
            class="reservation-button-submit"
            @click="() => submit()"
            :tabindex="3"
            :disabled="form.processing"
          >
            Réserver maintenant
            <LoaderCircle v-if="form.processing" class="login-form-loader" />
          </button>
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
  .reservation {
    display: flex;
    gap: 30px;
  }

  .reservation-left-box {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .reservation-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .reservation-calendars-box {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 40px;
  }

  .reservation-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
    text-align: center;
  }

  .reservation-calendar-box {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
  }

  .reservation-right-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 40%;
    min-width: 530px;
  }

  .reservation-info-box {
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    background-color: #49635D;
  }

  .reservation-sub-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #ffffff;
    line-height: 100%;
    margin-bottom: 20px;
  }

  .reservation-text-info {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
    margin-bottom: 5px;
  }

  .reservation-dates-inputs-box {
    display: flex;
    gap: 5px;
    margin-top: 40px;
  }

  .reservation-arrival-box {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding-left: 20px;
    border-top-left-radius: 100px;
    border-bottom-left-radius: 100px;
    background-color: #ffffff;
  }

  .reservation-departure-box {
    display: flex;
    flex-direction: column;
    width: 100%;
    border-top-right-radius: 100px;
    border-bottom-right-radius: 100px;
    background-color: #ffffff;
  }

  .reservation-label {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #49635D;
    line-height: 100%;
    margin-top: 10px;
    padding-left: 10px;
  }

  .reservation-input-date {
    height: 30px;
    border: 0;
    border-radius: 10px;
    padding: 0 10px;
    margin-bottom: 10px;
    background-color: transparent;
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #000000;
  }

  .reservation-errors-box {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    text-align: center;
  }

  .reservation-error-text {
    font-family: Calibri, sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    line-height: 100%;
  }

  .reservation-button-box {
    display: flex;
    justify-content: center;
  }

  .reservation-button-submit {
    height: 50px;
    padding: 5px 30px;
    border: 0;
    border-radius: 8px;
    margin-top: 20px;
    background-color: #ffffff;
    color: #000000;
    font-size: 20px;
    font-weight: bold;
    font-family: Calibri, sans-serif;
    cursor: pointer;
    transition: 0.25s;
  }

  .reservation-button-submit:hover {
    background-color: #F3EEE7;
  }

  @media screen and (max-width: 1280px) {
    .reservation {
      flex-direction: column;
    }

    .reservation-right-box {
      width: 100%;
    }
  }

  @media screen and (max-width: 600px) {
    .reservation {
      gap: 20px;
    }

    .reservation-calendars-box {
      flex-direction: column;
      gap: 20px;
    }

    .reservation-right-box {
      min-width: auto;
    }

    .reservation-dates-inputs-box {
      flex-direction: column;
    }

    .reservation-arrival-box, .reservation-departure-box {
      border-radius: 100px;
      padding: 0 20px;
    }
  }
</style>
