<script setup>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    v: "weekly",
  });

  let map;

  async function initMap() {
    const position = { lat: 48.85341, lng: 2.3488 };
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
      zoom: 14,
      center: position,
      mapId: "DEMO_MAP_ID",
    });

    const marker = new AdvancedMarkerElement({
      map: map,
      position: position,
      title: "Marker",
    });
  }

  initMap();
</script>

<template>
  <div class="map layout-container">
    <div id="map" class="map-google"></div>
  </div>
</template>

<style scoped>
  .map-google {
    width: 100%;
    aspect-ratio: 1350 / 700;
    border-radius: 60px;
  }

  @media screen and (max-width: 1020px) {
    .map-google {
      width: 100%;
      aspect-ratio: 1350 / 700;
      border-radius: 30px;
    }
  }

  @media screen and (max-width: 1000px) {
    .map-google {
      aspect-ratio: 5 / 3;
    }
  }

  @media screen and (max-width: 600px) {
    .map-google {
      aspect-ratio: 5 / 4;
      border-radius: 12px;
    }
  }

  @media screen and (max-width: 500px) {
    .map-google {
      aspect-ratio: 7 / 6;
    }
  }
</style>
