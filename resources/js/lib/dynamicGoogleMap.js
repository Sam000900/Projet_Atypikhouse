  import { useTemplateRef } from 'vue'
  
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    v: "weekly",
  });

  let map;
  let marker;
  export const inputLatitude = useTemplateRef('inputLatitude');
  export const inputLongitude = useTemplateRef('inputLongitude');

  export async function initMap(latitude, longitude, onPositionChange) {
    let position;
    position = {
      lat: typeof latitude === 'number' ? latitude : 48.85341,
      lng: typeof longitude === 'number' ? longitude : 2.3488
    };
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
      zoom: 12,
      center: position,
      mapId: "DEMO_MAP_ID",
    });

    map.addListener("click", (event) => {
      const coords = addMarker(event.latLng);
      if (onPositionChange) {
        onPositionChange([coords[0], coords[1]]);
      }
    });

    if (typeof latitude === 'number' && typeof longitude === 'number') {
      const position = { lat: latitude, lng: longitude };
      marker = new google.maps.Marker ({ position, map });
      marker.setMap(map);
    }
  }
  
  export function addMarker(position) {
    if (marker) {
      marker.setMap(null);
    }
    marker = new google.maps.Marker ({ position, map });
    marker.setMap(map);

    return [position.lat(), position.lng()];
  }

  export function updateMarkerPosition(e) {
    marker.setMap(null);
    const position = {
      lat: parseFloat(inputLatitude.value.value),
      lng: parseFloat(inputLongitude.value.value)
    };
    marker = new google.maps.Marker ({ position, map });
    marker.setMap(map);
  }