<template>
	<v-card>
    <v-form ref="form" class="form-center">
			<v-card-title>
				<span class="headline">{{ formTitle }}</span>
			</v-card-title>

			<v-card-text>
				<v-container>
					<v-row>
						<v-col
							cols="12"
							sm="6"
							md="4"
						>
							<v-text-field
								v-model="formValues.name"
								label="Nom"
								:rules="nameRules"
								required
								outline
								dense
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
						>
							<v-menu
								v-model="menu"
								:close-on-content-click="false"
								:nudge-right="40"
								transition="scale-transition"
								offset-y
								min-width="auto"
							>
								<template v-slot:activator="{ on, attrs }">
									<v-text-field
										v-model="formValues.dateDebut"
										label="Date de début"
										:rules="dateRules"
										required
										outline
										dense
										prepend-icon="mdi-calendar"
										readonly
										v-bind="attrs"
										v-on="on"
									></v-text-field>
								</template>
								<v-date-picker
									v-model="formValues.dateDebut"
									@input="menu = false"
								></v-date-picker>
							</v-menu>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
						>
							<v-menu
								v-model="menu2"
								:close-on-content-click="false"
								:nudge-right="40"
								transition="scale-transition"
								offset-y
								min-width="auto"
							>
								<template v-slot:activator="{ on, attrs }">
									<v-text-field
										v-model="formValues.dateFin"
										label="Date de fin"
										:rules="dateRules"
										required
										outline
										dense
										prepend-icon="mdi-calendar"
										readonly
										v-bind="attrs"
										v-on="on"
									></v-text-field>
								</template>
								<v-date-picker
									v-model="formValues.dateFin"
									@input="menu2 = false"
								></v-date-picker>
							</v-menu>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
						>
							<v-select
								v-model="formValues.etat"
								:items="select.etats"
								item-text="value"
								item-value="key"
								label="Etat"
								:rules="nameRules"
								required
								outline
								dense
							/>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
						>
							<v-text-field
								v-model="formValues.token"
								label="Token"
								:rules="nameRules"
								required
								outline
								dense
							/>
						</v-col>
					</v-row>
				</v-container>
			</v-card-text>

			<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn
					color="blue darken-1"
					text
					@click="$emit('close')"
				>
					Annuler
				</v-btn>
				<v-btn
					color="blue darken-1"
					text
					@click="submit"
				>
					Sauvegarder
				</v-btn>
			</v-card-actions>
		</v-form>
	</v-card>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'LoginForm',
	props: {
		formTitle: {
			type: String,
			required: false,
			default: "Nouveau projet"
		},
		projet: {
			type: Object,
			required: false,
			default: () => {return {}}
		},
		edit: {
			type: Boolean,
			required: false,
			default: false
		}
	},
	watch: {
		projet: function (val) {
			if(this.edit) {
				this.formValues = {...val}
			}
		}
	},
  data: function () {
    return {
			menu: false,
			menu2: false,
			nameRules: [
				v => !!v || 'Le nom du projet est requis.',
			],
			dateRules: [
        v => !!v || 'La date est requise.',
      ],
      formValues: this.initEmptyForm(),
      loadingForm: false,
			select: {
				etats: [
					{key: "PRIVE", value: "Privé"},
					{key: "PROTEGE", value: "Protégé"},
					{key: "PUBLIC", value: "Public"},
				]
			}
    }
  },
  methods: {
    ...mapActions('projet', ['create']),
		...mapActions('control', ['showPopup']),
    async submit () {
      if (this.$refs.form.validate()) {
        this.loadingForm = true;
				// TODO: décommenter lorsque la connexion api sera faite
        // try {
        //   const response = await this.create(this.formValues);
        //   this.loadingForm = false;
        //   if (response.status === 200) {
        //     this.showPopup({color: 'success', text: "Le projet a bien été créé."})
				// 		this.$emit("save", response.data.projet);
        //   } else {
        //     this.showPopup({color: 'red', text: "Une erreur est survenue."})
        //   }
        // }
        // catch (e) {
        //   this.loadingForm = false;
        //   this.showPopup({color: 'red', text: "Une erreur est survenue."})
        // }
				this.showPopup({color: 'success', text: "Le projet a bien été créé."})
				this.$emit("save", this.formValues);
      }
    },
    initEmptyForm () {
      return {
        name: '',
        dateDebut: '',
        dateFin: '',
        etat: '',
        token: '',
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
