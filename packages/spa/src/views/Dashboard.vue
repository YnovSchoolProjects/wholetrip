<template>
  <div class="dashboard">
    <v-container class="center-menu">
      <v-row>
        <v-col md="6">
          <v-card
            class="card card-family"
            color="#ABC8E2"
            style="
              background-image: url('https://images.unsplash.com/photo-1511895426328-dc8714191300?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80');
              background-size: cover;
              background-repeat: no-repeat;
            "
            :to="{ name: 'Family' }"
          >
            <v-card-title primary-title class="dash-card-title">
              Ma famille
            </v-card-title>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="6">
          <v-card
            class="card card-list"
            color="#375D81"
            :to="{ name: 'Lists' }"
            style="
              background-image: url('https://images.unsplash.com/photo-1578450671530-5b6a7c9f32a8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=975&q=80');
              background-size: cover;
              background-repeat: no-repeat;
            "
          >
            <v-card-title primary-title class="dash-card-title">
              Listes
            </v-card-title>
          </v-card>
        </v-col>
        <v-col md="6">
          <v-card
            class="card card-calendar"
            color="#183152"
            :to="{ name: 'Calendar' }"
            style="
              background-image: url('https://images.unsplash.com/photo-1506784365847-bbad939e9335?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1948&q=80');
              background-size: cover;
              background-repeat: no-repeat;
            "
          >
            <v-card-title primary-title class="dash-card-title">
              Calendrier
            </v-card-title>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data: function () {
    return {};
  },
};
</script>

<style scoped>
.center-menu .row .col {
  margin: 0 auto;
}

.card {
  justify-content: center;
  color: white;
  border-radius: 20px !important;
}

.card-family {
  height: 35vh;
}

.card-family div {
  justify-content: center;
  align-items: center;
  height: 100%;
}

.card-calendar {
  height: 35vh;
  width: 40vw;
  display: flex !important;
}

.card-list {
  height: 35vh;
  width: 40vw;
  display: flex !important;
}

.dash-card-title {
  font-size: 1.4rem !important;
  font-weight: 800 !important;
}
</style>
