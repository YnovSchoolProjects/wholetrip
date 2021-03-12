<template>
  <div class="register">
    <v-container>
      <v-row>
        <v-col>
          <register-form />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import RegisterForm from "@/components/registerForm";
import { mapActions } from "vuex";

export default {
  name: "Register",
  components: { RegisterForm },
  mounted() {
    this.setPreviousRoute('/')
  },
  methods: {
    ...mapActions('control', ['setPreviousRoute']),
  }
};
</script>

<style scoped>
</style>
