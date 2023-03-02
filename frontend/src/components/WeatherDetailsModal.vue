<script>
export default {
  props: ["weather_data"],
};
</script>
<template>
  <div>
    <div class="modal-header">
      <h4 class="modal-title">
        {{ weather_data?.name }}|<img
          :src="weather_data?.weather_data?.condition_icon"
          alt=""
        />
      </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body" v-if="weather_data?.weather_data?.status">
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              Location:
              {{
                weather_data.weather_data.location_name +
                "|" +
                weather_data.weather_data.location_country
              }}
            </li>
          </ul>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              Temperature: {{ weather_data.weather_data.temp_c }} C /
              {{ weather_data.weather_data.temp_f }} F.
              <br />
              Feels Like: {{ weather_data.weather_data.feelslike_c }} C /
              {{ weather_data.weather_data.feelslike_f }} F.
            </li>
          </ul>
        </div>
      </div>
      <!-- Visibility -->
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              Visibility {{ weather_data.weather_data.vis_km }} KM /
              {{ weather_data.weather_data.vis_miles }} MILE
            </li>
          </ul>
        </div>
      </div>
      <!-- Wind details -->
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              Wind Speed {{ weather_data.weather_data.wind_kph }} KPH /
              {{ weather_data.weather_data.wind_mph }} MPH
            </li>
            <li class="list-group-item">
              Wind Direction: {{ weather_data.weather_data.wind_dir }}. Wind
              Degree: {{ weather_data.weather_data.wind_degree }} Degrees
            </li>
            <li class="list-group-item">
              Wind Gust : {{ weather_data.weather_data.gust_kph }} KPH /
              {{ weather_data.weather_data.gust_mph }} MPH.
            </li>
          </ul>
        </div>
      </div>
      <!-- //Wind -->

      <!--  -->
      <div class="card">
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              Humidity: {{ weather_data.weather_data.humidity }}. UV
              {{ weather_data.weather_data.uv }}.
            </li>
          </ul>
        </div>
      </div>
      <!--//  -->
    </div>
    <div class="modal-body" v-else>
      <h1 class="text-danger" align="center">!!Error!!</h1>
      <ul>
        <li>Error Code:{{ weather_data?.weather_data?.error_code }}</li>
        <li>
          Error Message:
          <p>{{ weather_data?.weather_data?.error_message }}</p>
        </li>
      </ul>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
        Close
      </button>
    </div>
  </div>
</template>
