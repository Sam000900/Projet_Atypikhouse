<script setup>
  import { reservationFormatFrenchDateRange } from "@/lib/reservationFormatFrenchDateRange.js";
  import { getReservationStatus } from "@/lib/getReservationStatus.js";

  const props = defineProps(['reservationInfo']);
  const reservationStatus = getReservationStatus(props.reservationInfo.arrival_date, props.reservationInfo.departure_date);
</script>

<template>
  <div class="dashboardreservationcard">
    <div class="dashboardreservationcard-left">
      <img :src="'/' + props.reservationInfo.accommodation.main_image" alt="Image du logement" class="dashboardreservationcard-image"/>
    </div>
    <div class="dashboardreservationcard-right">
      <div class="dashboardreservationcard-content-box">
        <div class="dashboardreservationcard-texts">
          <h2 class="dashboardreservationcard-title">{{ props.reservationInfo.accommodation.name }}</h2>
          <p class="dashboardreservationcard-text">
            {{ reservationFormatFrenchDateRange(props.reservationInfo.arrival_date, props.reservationInfo.departure_date) }}
          </p>
          <p class="dashboardreservationcard-title">{{ props.reservationInfo.price_paid }} €</p>
        </div>
        <div>
          <a class="dashboardreservationcard-display-info">
            Voir les détails
            <VsxIcon iconName="ArrowRight" color="#296242" size="25" type="linear" />
          </a>
        </div>
      </div>
      <div class="dashboardreservationcard-status-box">
        <div>
          <div v-if="reservationStatus === 'Confirmée'" class="dashboardreservationcard-confirmed"><p>Confirmée</p></div>
          <div v-else-if="reservationStatus === 'En cours'" class="dashboardreservationcard-ongoing"><p>En Cours</p></div>
          <div v-else="reservationStatus === 'Terminée'" class="dashboardreservationcard-finished"><p>Terminée</p></div>
        </div>
        <div>
          <a class="dashboardreservationcard-cancel">Annuler</a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .dashboardreservationcard {
    display: flex;
    width: 100%;
    max-width: 1000px;
    aspect-ratio: 12/3;
    border-radius: 24px;
    background-color: #ffffff;
  }

  .dashboardreservationcard-left {
    height: 100%;
    aspect-ratio: 1/1;
    flex-shrink: 0;
    border-radius: inherit;
    background-color: #747474;
  }

  .dashboardreservationcard-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
    user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }

  .dashboardreservationcard-right {
    display: flex;
    width: 100%;
    padding: 15px;
    gap: 30px;
  }

  .dashboardreservationcard-content-box {
    flex: 1;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 100%;
  }

  .dashboardreservationcard-texts {
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .dashboardreservationcard-title {
    font-family: Calibri, sans-serif;
    font-size: 28px;
    font-weight: bold;
    color: #000000;
    line-height: 100%;
    word-break: break-word;
  }

  .dashboardreservationcard-text {
    font-family: Calibri, sans-serif;
    font-size: 18px;
    font-weight: 400;
    color: #5D6679;
    line-height: 100%;
  }

  .dashboardreservationcard-display-info {
    display: inline-flex;
    gap: 10px;
    font-family: Calibri, sans-serif;
    font-size: 24px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
    cursor: pointer;
  }

  .dashboardreservationcard-status-box {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;
  }

  .dashboardreservationcard-confirmed, .dashboardreservationcard-ongoing, .dashboardreservationcard-finished {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 35px;
    padding: 0 20px;
    border-radius: 40px;
    background-color: #DCFCE7;
  }

  .dashboardreservationcard-confirmed { background-color: #DCFCE7; }
  .dashboardreservationcard-ongoing { background-color: #fdd2ff; }
  .dashboardreservationcard-finished { background-color: #DBEAFE; }

  .dashboardreservationcard-confirmed p, .dashboardreservationcard-ongoing p, .dashboardreservationcard-finished p {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: #296242;
    line-height: 100%;
  }

  .dashboardreservationcard-confirmed p { color: #296242; }
  .dashboardreservationcard-ongoing p { color: #b12fb7; }
  .dashboardreservationcard-finished p { color: #2F7BEB; }

  .dashboardreservationcard-cancel {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: bold;
    color: crimson;
    line-height: 100%;
    cursor: pointer;
  }

  @media screen and (max-width: 800px) {
    .dashboardreservationcard {
      aspect-ratio: 12 / 5;
    }

    .dashboardreservationcard-left {
      aspect-ratio: auto;
      width: 100px;
    }
  }

    @media screen and (max-width: 750px) {
    .dashboardreservationcard {
      aspect-ratio: 12 / 5;
      min-height: 250px;
    }

    .dashboardreservationcard-left {
      display: none;
    }

    .dashboardreservationcard-right {
      flex-direction: column-reverse;
    }

    .dashboardreservationcard-right {
      gap: 20px;
    }

    .dashboardreservationcard-status-box {
      flex-direction: row;
    }
  }
</style>