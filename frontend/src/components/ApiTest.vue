<script lang="ts">
import WeatherDetailsModal from "@/components/WeatherDetailsModal.vue";

interface ApiResponse {
  users: Array<{
    id: number;
    name: string;
    email: string;
    longitude: number;
    latitude: number;
    weather_data: {
      status: string;
      condition_icon: string;
      error_message: string;
      updated_at: string;
    }
  }>
}

export default {
  data() {
    return {
      apiResponse: null as ApiResponse | null,
      statusCode: null as number | null,
      currentUserDetails: null as any,
    }
  },
  components: {
    WeatherDetailsModal,
  },
  created() {
    this.fetchData();
  },
  methods: {
    convertDate(isoDateString: string) {
      const newDate = new Date(isoDateString);
      return newDate.toLocaleString();
    },
    weatherDetails(user_weather_data: any) {
      this.currentUserDetails = user_weather_data;
    },
    async fetchData() {
      const url = "http://localhost:8080";
      try {
        const response = await fetch(url);
        this.statusCode = response.status;
        if (this.statusCode === 200) {
          this.apiResponse = await response.json();
        }
      } catch(error: any) {
        alert("Error"+error.message)
      }
    },
  },
};
</script>

<template>
  <div v-if="!statusCode">Loading the data.....</div>
  <div v-if="statusCode == 204">
    <h1>No Users found</h1>
  </div>

  <div v-if="Number(statusCode) >= 500">
    <h1>Internal error please try again later</h1>
  </div>

  <div v-if="apiResponse">
    <h1>Users ({{ apiResponse.users.length }}).</h1>
    <code>
      <div v-if="apiResponse.users">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>S/N</th>
              <th>User Name</th>
              <th>EMail</th>
              <th>Weather Summary.</th>
              <th>Lat</th>
              <th>Long</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            <tr
              @click="weatherDetails(user)"
              v-for="(user, index) in apiResponse.users"
              title="Click for more"
              data-bs-toggle="modal"
              v-bind:key="index"
              data-bs-target="#myModal"
            >
              <td>
                {{ user.id }}
              </td>
              <td>
                {{ user.name }}
              </td>
              <td>
                {{ user.email }}
              </td>
              <td>
                <div v-if="user.weather_data.status">
                  <img :src="user.weather_data.condition_icon" alt="" />
                </div>
                <div
                  v-else
                  :title="user.weather_data.error_message"
                  class="text-danger"
                >
                  Error!
                </div>
              </td>
              <td>
                {{ user.longitude }}
              </td>
              <td>
                {{ user.latitude }}
              </td>
              <td>
                {{ convertDate(user.weather_data.updated_at) }}
              </td>
            </tr>
          </tbody>
        </table>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <WeatherDetailsModal
                :weather_data="currentUserDetails"
              ></WeatherDetailsModal>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <h1>No Users found</h1>
      </div>
    </code>
  </div>
</template>
