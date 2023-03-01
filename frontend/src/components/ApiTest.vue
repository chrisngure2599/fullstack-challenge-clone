<script>
export default {
  data: () => ({
    apiResponse: null
  }),

  created() {
    this.fetchData()
  },
  computed:{
    
  },
  methods: {
    weather_data(user_weather_data){
      if(user_weather_data!==null){
        return user_weather_data
        return Object.entries(user_weather_data);

      }else{
        return "N/A";
      }
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
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in apiResponse.users" title="Click for more" >
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
               <img :src="weather_data(user.weather_data).condition_icon" alt=""> 
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else >
      <h1>No Users found</h1>
    </div>
    </code>
  </div>
</template>