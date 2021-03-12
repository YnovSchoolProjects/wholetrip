<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <login-form />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import LoginForm from '@/components/loginForm'
export default {
  name: 'Home',
  components: { LoginForm }
}
</script>