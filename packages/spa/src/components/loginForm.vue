<template>
  <v-container>
    <v-form ref="form" class="form-center">
      <v-row>
        <v-col 
          md="6"
          sm="12"
          xs="12"
        >
          <v-img 
            class="margin-auto"
            lazy-src="@/assets/logo.png"
            max-width="100"
            src="../assets/logo.png"
          />
        </v-col>
      </v-row>
      
      <v-row>
        <v-col 
          md="6 "
          sm="12"
          xs="12"
        >
          <v-text-field 
            v-model="formValues.email"
            label="Email"
            :rules="emailRules"
            required
            outline
            dense
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col
          md="6 "
          sm="12"
          xs="12"
        >
          <v-text-field 
            v-model="formValues.username"
            label="Nom"
            :rules="nameRules"
            required
            outline
            dense
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col
          md="6"
          sm="12" 
          xs="12"
        >
          <v-text-field 
            v-model="formValues.password"
            label="Mot de passe"
            :rules="passwordRules"
            type="password"
            required
            outline
            dense
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col md="6" sm="12" xs="12">
          <v-btn
            class="form-btn"
            color="#375D81"
            @click="submitConnexion"
            :loading="loadingForm"
          >
            Connexion
          </v-btn>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="6" sm="12" xs="12">
          <v-btn 
          class="form-btn"
          color="#375D81"
          :to="{name: 'Register'}">Inscription</v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'LoginForm',
  data: function () {
    return {
      emailRules: [
        v => !!v || 'L\'email est requis.',
        v => /^(([^<>()[\]\\.,;:\s@']+(\.[^<>()\\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'L\'email doit être valide.'
      ],
      passwordRules: [
        v => !!v || 'Le mot de passe est requis.'
      ],
      nameRules: [
        v => !!v || 'Le nom est requis.'
      ],
      formValues: this.initEmptyForm(),
      loadingForm: false
    }
  },
  methods: {
    ...mapActions('auth', ['login']),
    ...mapActions('control', ['showPopup']),
    async submitConnexion () {
      if (this.$refs.form.validate()) {
        this.loadingForm = true;
        try {
          const response = await this.login(this.formValues);
          this.loadingForm = false;
          if (response.status === 200) {
            this.showPopup({color: 'success', text: "Vous êtes bien connecté."})
            this.$router.push({name: 'Dashboard'});
          } else {
            this.showPopup({color: 'red', text: "Une erreur est survenue."})
          }
        }
        catch (e) {
          this.loadingForm = false;
          this.showPopup({color: 'red', text: "Une erreur est survenue."})
        }
      }
    },
    initEmptyForm () {
      return {
        email: '',
        username: '',
        password: '',
      }
    }
  }
}
</script>
<style scoped>
.form-btn {
  color: white;
}
</style>