<script setup>
  import InfoTable from '../small/InfoTable.vue';

  const props = defineProps(['config', 'data', 'isShown', 'selectedItem']);
  const emit = defineEmits(['go-back', 'show-item', 'delete-item', 'close-item']);
</script>

<template>
  <div class="datatable">
    <div class="datatable-top">
      <h2>{{ config.title }}</h2>
      <button v-if="!props.isShown" class="datatable-button-previous" @click="$emit('go-back')">Retour</button>
      <button v-if="selectedItem" class="datatable-button-previous" @click="$emit('close-item')">Retour</button>
    </div>

    <div class="datatable-table-box" v-if="!props.isShown">
      <div v-if="props.data.length === 0">
        <p>{{ config.empty }}</p>
      </div>
      
      <table>
        <thead>
          <tr>
            <th v-for="(head, index) in config.thead" :key="index">{{ head }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in props.data" :key="index">

            <template v-if="config.title === 'Utilisateurs'">
              <td>{{ item.id }}</td>
              <td>{{ item.email }}</td>
              <td>{{ item.firstname }}</td>
              <td>{{ item.lastname }}</td>
              <td>{{ item.role }}</td>
              <td>
                <button
                  :style="{ borderRight: item.role === 'admin' ? '0' : '' }"
                  @click="$emit('show-item', item)"
                  class="datatable-button datatable-button-display">Voir</button>
                <button
                  v-if="item.role !== 'admin'"
                  class="datatable-button datatable-button-delete"
                  @click="$emit('delete-item', item, index)">Supprimer</button>
              </td>
            </template>

            <template v-else-if="config.title === 'Logements'">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>
                <button
                  @click="$emit('show-item', item)"
                  class="datatable-button datatable-button-display">Voir</button>
                <button
                  class="datatable-button datatable-button-delete"
                  @click="$emit('delete-item', item, index)">Supprimer</button>
              </td>
            </template>

            <template v-else-if="config.title === 'Expériences'">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>
                <button
                  @click="$emit('show-item', item)"
                  class="datatable-button datatable-button-display">Voir</button>
                <button
                  class="datatable-button datatable-button-delete"
                  @click="$emit('delete-item', item, index)">Supprimer</button>
              </td>
            </template>

            <template v-else-if="config.title === 'Articles'">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>
                <button
                  @click="$emit('show-item', item)"
                  class="datatable-button datatable-button-display">Voir</button>
                <button
                  class="datatable-button datatable-button-delete"
                  @click="$emit('delete-item', item, index)">Supprimer</button>
              </td>
            </template>

          </tr>
        </tbody>
      </table>
    </div>

    <div v-else>
      <div v-if="selectedItem">
        <h3>Détails</h3>
        <InfoTable :item="selectedItem" :configInfo="config.title" />
      </div>
    </div>
  </div>
</template>

<style scoped>
  .datatable {
    display: flex;
    flex-direction: column;
  }

  .datatable-table-box {
    overflow-y: auto;
  }

  .datatable-top {
    display: flex;
    justify-content: space-between;
  }

  .datatable-button-previous {
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

  .datatable-button-previous:hover {
    background-color: #357d54;
  }

  table {
    width: 100%;
    margin-top: 30px;
    background-color: black;
    table-layout: fixed;
    min-width: 1000px;
  }

  th, td {
    padding: 5px 10px;
    background-color: #ffffff;
    overflow-y: auto;
    word-break: break-word;
    text-align: start;
  }

  th {
    text-align: start;
    font-weight: bold;
    font-size: 20px;
  }

  table th:first-child,
  table td:first-child {
    width: 80px;
  }

  table th:last-child,
  table td:last-child {
    width: 300px;
  }

  table td:last-child {
    display: flex;
    align-items: stretch;
    padding: 0;
  }

  .datatable-button {
    flex: 1;
    height: 100%;
    width: 50%;
    border: 0;
    padding: 6px 0;
    cursor: pointer;
    transition: 0.25s;
  }

  .datatable-button-display {
    border-right: solid black 2px;
    background-color: orange;
  }

  .datatable-button-display:hover {
    background-color: rgb(255, 211, 129);
  }

  .datatable-button-delete {
    background-color: crimson;
    color: #ffffff;
  }

  .datatable-button-delete:hover {
    background-color: rgb(217, 79, 105);
  }
</style>