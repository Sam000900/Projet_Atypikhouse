<script setup>
  import { watch } from 'vue';
  const props = defineProps(['mapData']);

  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    v: "weekly",
  });

  let map;

  async function initMap() {
    const position = { 
      lat: typeof props.mapData.latitude === 'number' ? props.mapData.latitude : 48.85341,
      lng: typeof props.mapData.longitude === 'number' ? props.mapData.longitude : 2.3488
    };
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
      zoom: 12,
      center: position,
      mapId: "DEMO_MAP_ID",
    });

    const marker = new AdvancedMarkerElement({
      map: map,
      position: position,
    });
  }

  watch(
    () => [props.mapData.latitude, props.mapData.longitude],
    ([newLat, newLng]) => {
      if (typeof newLat === 'number' && typeof newLng === 'number') {
        initMap();
      }
    },
    { immediate: true }
  );

</script>

<template>
  <div class="mapaccommodation layout-container">
    <h2 class="mapaccommodation-title">Localisation du bien</h2>
    <div class="mapaccommodation-main">
      <div class="mapaccommodation-google-box">
        <div class="mapaccommodation-google" id="map"></div>
      </div>
      <div class="mapaccommodation-info-box">
        <h3 class="mapaccommodation-info-title">Informations autour du bien</h3>
        <div class="mapaccommodation-info-content">
          <div class="mapaccommodation-unique-info-box">
            <VsxIcon iconName="Location" color="#000000" size="25" type="linear" />
            <p class="mapaccommodation-info-text">Le phare de Richard</p>
          </div>

          <div class="mapaccommodation-unique-info-box">
            <VsxIcon iconName="Location" color="#000000" size="25" type="linear" />
            <p class="mapaccommodation-info-text">Grottes de Regulus et des Fontaines</p>
          </div>
          
          <div class="mapaccommodation-unique-info-box">
            <VsxIcon iconName="Location" color="#000000" size="25" type="linear" />
            <p class="mapaccommodation-info-text">Estuaire de la Gironde</p>
          </div>

          <div class="mapaccommodation-unique-info-box">
            <VsxIcon iconName="Location" color="#000000" size="25" type="linear" />
            <p class="mapaccommodation-info-text">Lac du Bourget</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .mapaccommodation {
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .mapaccommodation-title {
    font-family: "Larken-Medium";
    font-size: 40px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .mapaccommodation-main {
    display: flex;
    margin-top: 40px;
    gap: 30px;
  }

  .mapaccommodation-google-box {
    flex: 1;
    display: flex;
    border-radius: 20px;
  }

  .mapaccommodation-google {
    width: 100%;
    height: 600px;
    border-radius: inherit;
  }

  .mapaccommodation-info-box {
    display: none;
    /* display: flex; */
    flex-direction: column;
    width: 35%;
    min-width: 400px;
  }

  .mapaccommodation-info-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 40px;
  }

  .mapaccommodation-unique-info-box {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .mapaccommodation-info-title {
    font-family: "Larken-Medium";
    font-size: 32px;
    font-weight: 400;
    color: #296242;
    line-height: 100%;
  }

  .mapaccommodation-info-text {
    font-family: Calibri, sans-serif;
    font-size: 20px;
    font-weight: 400;
    color: #000000;
    line-height: 100%;
  }

  @media screen and (max-width: 1150px) {
    .mapaccommodation-google {
      height: 400px;
    }
  }

  @media screen and (max-width: 950px) {
    .mapaccommodation-main {
      flex-direction: column;
    }

    .mapaccommodation-info-box {
      width: 100%;
      min-width: auto;
    }

    .mapaccommodation-google {
      aspect-ratio: 16/9;
      height: auto;
    }
  }

  @media screen and (max-width: 500px) {
    .mapaccommodation-google {
      aspect-ratio: 1/1;
    }
  }
</style>