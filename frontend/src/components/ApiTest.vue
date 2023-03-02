<script>
import WeatherDetailsModal from "@/components/WeatherDetailsModal.vue";
export default {
  data: () => ({
    apiResponse: null,
    currentUserDetails:null
  }),
  components: {
    WeatherDetailsModal
  },

  created() {
    this.fetchData()
  },
  computed:{
    
  },
  methods: {
    weather_details(user_weather_data){
      this.currentUserDetails=user_weather_data;
    },
    async fetchData() {
      const url = 'http://localhost:8000'
      this.apiResponse = await (await fetch(url)).json()
    }
  }
}
</script>

<template>
  <div v-if="!apiResponse">
    Loading the data.....
  </div>

  <div v-if="apiResponse">
    <h1>Users.</h1>
    <code>
      <!-- {{ apiResponse }} -->
    <!-- Looping through the Users -->
    <div v-if="apiResponse.users" >
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>
              S/N
            </th>
            <th>
              User Name
            </th>
            <th>
              EMail
            </th>
            <th>
              Weather Summary.
            </th>
            <th>Lat</th>
            <th>Long</th>
          </tr>
        </thead>
        <tbody>
          <tr @click="weather_details(user)" v-for="user in apiResponse.users" title="Click for more" data-bs-toggle="modal" data-bs-target="#myModal" >
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
                <div v-if="user.weather_data.status" >
                  <img :src="user.weather_data.condition_icon" alt=""> 
                </div>
                <div v-else :title="user.weather_data.error_message"  class="text-danger" >
                
                  Error!
                </div>
              </td>
              <td>
                {{ user.longitude }}
              </td>
              <td>
                {{ user.latitude }}
              </td>
          </tr>
        </tbody>
      </table>
      <!-- The Modal -->
<div class="modal fade" id="myModal" >
  <div class="modal-dialog">
    <div  class="modal-content">
      <WeatherDetailsModal  :weather_data=currentUserDetails ></WeatherDetailsModal >
    </div>
  </div></div>
    </div>
    <div v-else >
      <h1>No Users found</h1>
    </div>
    </code>
  </div>
</template>