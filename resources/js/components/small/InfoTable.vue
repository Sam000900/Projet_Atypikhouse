<script setup>
  import { formatDate } from '@/lib/formatDate';
  const props = defineProps(['item', 'configInfo']);

  function formatCheckbox(value) {
    return value ? "Oui" : "Non";
  }
</script>

<template>
  <div class="infotable">

    <div v-if="props.configInfo === 'Utilisateurs'">
      <table>
        <tr><td><b>Id</b></td><td>{{ props.item.id }}</td></tr>
        <tr><td><b>Image</b></td><td>
          <img :src="'/' + props.item.image_path" alt="Image de l'utilisateur" class="infotable-image"/>
        </td></tr>
        <tr><td><b>Email</b></td><td>{{ props.item.email }}</td></tr>
        <tr><td><b>Prénom</b></td><td>{{ props.item.firstname }}</td></tr>
        <tr><td><b>Nom</b></td><td>{{ props.item.lastname }}</td></tr>
        <tr><td><b>Téléphone</b></td><td>{{ props.item.phone }}</td></tr>
        <tr><td><b>Rôle</b></td><td>{{ props.item.role }}</td></tr>
        <tr><td><b>Date de création de l'utilisateur</b></td><td>{{ formatDate(props.item.created_at) }}</td></tr>
        <tr><td><b>Date de modification de l'utilisateur</b></td><td>{{ formatDate(props.item.updated_at) }}</td></tr>
      </table>

      <div>
        <h3>Logements liés à l'utilisateur</h3>
        <table v-if="props.item.accommodations.length !== 0">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Titre</b></th>
          </tr>
          <tr
            v-for="(accommodation, index) in props.item.accommodations"
            :key="index"
          >
            <td class="infotable-id">{{ accommodation.id }}</td>
            <td>{{ accommodation.name }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas de logement lié à l'utilisateur</p>
        </div>
      </div>

      <div v-if="props.item.role === 'admin'">
        <h3>Expériences liées à l'utilisateur</h3>
        <table v-if="props.item.experiences.length !== 0">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Titre</b></th>
          </tr>
          <tr
            v-for="(experience, index) in props.item.experiences"
            :key="index"
          >
            <td class="infotable-id">{{ experience.id }}</td>
            <td>{{ experience.name }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas d'expérience liée à l'utilisateur</p>
        </div>
      </div>

      <div v-if="props.item.role === 'admin'">
        <h3>Articles liés à l'utilisateur</h3>
        <table v-if="props.item.articles.length !== 0">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Titre</b></th>
          </tr>
          <tr
            v-for="(article, index) in props.item.articles"
            :key="index"
          >
            <td class="infotable-id">{{ article.id }}</td>
            <td>{{ article.name }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas d'expérience liée à l'utilisateur</p>
        </div>
      </div>
    </div>

    <div v-else-if="props.configInfo === 'Logements'">
      <table>
        <tr><td><b>Id</b></td><td>{{ props.item.id }}</td></tr>
        <tr><td><b>Nom du logement</b></td><td>{{ props.item.name }}</td></tr>
        <tr><td><b>Type de logement</b></td><td>{{ props.item.type }}</td></tr>
        <tr><td><b>Superficie (m²)</b></td><td>{{ props.item.area }}</td></tr>
        <tr><td><b>Capacité d'accueil</b></td><td>{{ props.item.capacity }}</td></tr>
        <tr><td><b>Nombre de chambres</b></td><td>{{ props.item.bedrooms }}</td></tr>
        <tr><td><b>Département du logement</b></td><td>{{ props.item.department }}</td></tr>
        <tr><td><b>Commune du logement</b></td><td>{{ props.item.municipality }}</td></tr>
        <tr><td><b>Adresse complète</b></td><td>{{ props.item.address }}</td></tr>
        <tr><td><b>Latitude</b></td><td>{{ props.item.latitude }}</td></tr>
        <tr><td><b>Longitude</b></td><td>{{ props.item.longitude }}</td></tr>
        <tr><td><b>Wi-Fi</b></td><td><div :class="props.item.wifi ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.wifi) }}</td></tr>
        <tr><td><b>Climatisation</b></td><td><div :class="props.item.air_conditioning ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.air_conditioning) }}</td></tr>
        <tr><td><b>Parking</b></td><td><div :class="props.item.parking ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.parking) }}</td></tr>
        <tr><td><b>SPA</b></td><td><div :class="props.item.spa ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.spa) }}</td></tr>
        <tr><td><b>Cuisine équipée</b></td><td><div :class="props.item.equipped_kitchen ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.equipped_kitchen) }}</td></tr>
        <tr><td><b>Linge de maison fourni</b></td><td><div :class="props.item.household_linen_provided ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.household_linen_provided) }}</td></tr>
        <tr><td><b>Salle de bain</b></td><td><div :class="props.item.bathroom ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.bathroom) }}</td></tr>
        <tr><td><b>Fumeurs autorisés</b></td><td><div :class="props.item.smokers_allowed ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.smokers_allowed) }}</td></tr>
        <tr><td><b>Animaux acceptés</b></td><td><div :class="props.item.pets_allowed ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.pets_allowed) }}</td></tr>
        <tr><td><b>Evénements autorisés</b></td><td><div :class="props.item.events_allowed ? 'checkbox-true' : 'checkbox-false'"></div>{{ formatCheckbox(props.item.events_allowed) }}</td></tr>
        <tr><td><b>Tarif par nuit (€)</b></td><td>{{ props.item.price_night }}</td></tr>
        <tr><td><b>Nombre de nuits minimun</b></td><td>{{ props.item.min_number_nights }}</td></tr>
        <tr><td><b>Dépôt de garantie (€)</b></td><td>{{ props.item.security_deposit }}</td></tr>
        <tr><td><b>Frais de ménages (€)</b></td><td>{{ props.item.cleaning_charges }}</td></tr>
        <tr><td><b>Heure d'arrivée (heures:minutes)</b></td><td>{{ props.item.arrival_time }}</td></tr>
        <tr><td><b>Heure de départ (heures:minutes)</b></td><td>{{ props.item.departure_time }}</td></tr>
        <tr><td><b>Age minimum du locataire</b></td><td>{{ props.item.minimum_age }}</td></tr>
        <tr><td><b>Description détaillée</b></td><td>{{ props.item.description }}</td></tr>
        <tr><td><b>Règles supplémentaires</b></td><td>{{ props.item.additional_rules }}</td></tr>
        <tr><td><b>Date de création du logement</b></td><td>{{ formatDate(props.item.created_at) }}</td></tr>
        <tr><td><b>Date de modification du logement</b></td><td>{{ formatDate(props.item.updated_at) }}</td></tr>
      </table>

      <div>
        <h3>Utilisateur lié au logement</h3>
        <table v-if="props.item.user">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Email</b></th>
          </tr>
          <tr>
            <td class="infotable-id">{{ props.item.user.id }}</td>
            <td>{{ props.item.user.email }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas d'utilisateur lié au logement</p>
        </div>
      </div>
    </div>

    <div v-else-if="props.configInfo === 'Expériences'">
      <table>
        <tr><td><b>Id</b></td><td>{{ props.item.id }}</td></tr>
        <tr><td><b>Image</b></td><td>
          <img :src="'/' + props.item.image_path" alt="Image de l'expérience" class="infotable-image"/>
        </td></tr>
        <tr><td><b>Titre</b></td><td>{{ props.item.name }}</td></tr>
        <tr><td><b>Type</b></td><td>{{ props.item.type }}</td></tr>
        <tr><td><b>Département</b></td><td>{{ props.item.location }}</td></tr>
        <tr><td><b>Adresse complète</b></td><td>{{ props.item.address }}</td></tr>
        <tr><td><b>Nombre de personnes maximum</b></td><td>{{ props.item.max_number_persons }}</td></tr>
        <tr><td><b>Durée de l'expérience (heures:minutes)</b></td><td>{{ props.item.service_duration }}</td></tr>
        <tr><td><b>Prix de l'expérience (€)</b></td><td>{{ props.item.price }}</td></tr>
        <tr><td><b>Latitude</b></td><td>{{ props.item.latitude }}</td></tr>
        <tr><td><b>Longitude</b></td><td>{{ props.item.longitude }}</td></tr>
        <tr><td><b>Informations additionnelles</b></td><td>{{ props.item.additional_information }}</td></tr>
        <tr><td><b>Date de création de l'expérience</b></td><td>{{ formatDate(props.item.created_at) }}</td></tr>
        <tr><td><b>Date de modification de l'expérience</b></td><td>{{ formatDate(props.item.updated_at) }}</td></tr>
      </table>

      <div>
        <h3>Utilisateur lié à l'expérience</h3>
        <table v-if="props.item.user">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Email</b></th>
          </tr>
          <tr>
            <td class="infotable-id">{{ props.item.user.id }}</td>
            <td>{{ props.item.user.email }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas d'utilisateur lié à l'expérience</p>
        </div>
      </div>
    </div>

    <div v-else-if="props.configInfo === 'Articles'">
      <table>
        <tr><td><b>Id</b></td><td>{{ props.item.id }}</td></tr>
        <tr><td><b>Image</b></td><td>
          <img :src="'/' + props.item.image_path" alt="Image de l'article" class="infotable-image"/>
        </td></tr>
        <tr><td><b>Titre</b></td><td>{{ props.item.name }}</td></tr>
        <tr><td><b>Contenu</b></td><td>{{ props.item.text }}</td></tr>
        <tr><td><b>Conclusion</b></td><td>{{ props.item.conclusion }}</td></tr>
        <tr><td><b>Date de création de l'article</b></td><td>{{ formatDate(props.item.created_at) }}</td></tr>
        <tr><td><b>Date de modification de l'article</b></td><td>{{ formatDate(props.item.updated_at) }}</td></tr>
      </table>

      <div>
        <h3>Utilisateur lié à l'article</h3>
        <table v-if="props.item.user">
          <tr>
            <th class="infotable-id"><b>Id</b></th>
            <th><b>Email</b></th>
          </tr>
          <tr>
            <td class="infotable-id">{{ props.item.user.id }}</td>
            <td>{{ props.item.user.email }}</td>
          </tr>
        </table>
        <div v-else class="infotable-no-link">
          <p>Il n'y a pas d'utilisateur lié à l'article</p>
        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>
  table {
    width: 100%;
    margin: 30px 0;
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

  .infotable-image {
    max-width: 350px;
  }

  .checkbox-true, .checkbox-false  {
    display: inline-block;
    flex-shrink: 0;
    height: 15px;
    width: 15px;
    margin-right: 5px;
    border: solid #000000 1px;
    border-radius: 20px;
    background-color: lime;
    vertical-align: top;
  }

  .checkbox-true { background-color: lime; }
  .checkbox-false { background-color: crimson; }

  .infotable-id {
    width: 80px;
  }

  .infotable-no-link {
    margin: 30px 0;
  }
</style>