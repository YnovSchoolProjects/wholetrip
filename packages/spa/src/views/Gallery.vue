<template>
  <v-container>
    <v-row>
      <v-col cols="8">
        <image-gallery />
      </v-col>
      <v-col cols="4" class="align-justify">
        <h1>Mon voyage à Venise</h1>
        <div class="">
          📍 Venise, Murano, Burano <br />
          🗓 Du 02/04/2020 au 08/04/2020<br />
          📸 25 photos <br />
        </div>
        <v-file-input
          label="File input"
          filled
          prepend-icon="mdi-camera"
        ></v-file-input>
        <v-btn color="primary" dark>
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ImageGallery from "@/components/imageGallery.vue";
import { mapActions } from "vuex";

export default {
  name: "Gallery",
  components: {
    ImageGallery,
  },
  mounted() {
    this.setPreviousRoute("/");
  },
  methods: {
    ...mapActions("control", ["setPreviousRoute"]),
  },
};
</script>
