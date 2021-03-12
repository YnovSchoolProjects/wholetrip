<template>
  <div class="dashboard">
    <v-container class="center-menu">
			<v-row>
				<v-col>
					<v-data-table
					:headers="headers"
					:items="desserts"
					sort-by="calories"
					class="elevation-1"
				>
					<template v-slot:top>
						<v-toolbar
							flat
						>
							<v-toolbar-title>Mes projets de voyage</v-toolbar-title>
							<v-divider
								class="mx-4"
								inset
								vertical
							></v-divider>
							<v-spacer></v-spacer>
							<v-dialog
								v-model="dialog"
								max-width="500px"
							>
								<template v-slot:activator="{ on, attrs }">
									<v-btn
										color="primary"
										dark
										class="mb-2"
										v-bind="attrs"
										v-on="on"
									>
										New Item
									</v-btn>
								</template>
								<v-card>
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
														v-model="editedItem.name"
														label="Nom"
													></v-text-field>
												</v-col>
												<v-col
													cols="12"
													sm="6"
													md="4"
												>
													<v-text-field
														v-model="editedItem.dateDebut"
														label="Date de début"
													></v-text-field>
												</v-col>
												<v-col
													cols="12"
													sm="6"
													md="4"
												>
													<v-text-field
														v-model="editedItem.debutFin"
														label="Date de fin"
													></v-text-field>
												</v-col>
												<v-col
													cols="12"
													sm="6"
													md="4"
												>
													<v-text-field
														v-model="editedItem.etat"
														label="Etat"
													></v-text-field>
												</v-col>
												<v-col
													cols="12"
													sm="6"
													md="4"
												>
													<v-text-field
														v-model="editedItem.token"
														label="Token"
													></v-text-field>
												</v-col>
											</v-row>
										</v-container>
									</v-card-text>

									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn
											color="blue darken-1"
											text
											@click="close"
										>
											Annuler
										</v-btn>
										<v-btn
											color="blue darken-1"
											text
											@click="save"
										>
											Sauvegarder
										</v-btn>
									</v-card-actions>
								</v-card>
							</v-dialog>
							<v-dialog v-model="dialogDelete" max-width="500px">
								<v-card>
									<v-card-title class="headline">Etes vous sûr de vouloir supprimer ce projet ?</v-card-title>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn color="blue darken-1" text @click="closeDelete">Annuler</v-btn>
										<v-btn color="blue darken-1" text @click="deleteItemConfirm">Valider</v-btn>
										<v-spacer></v-spacer>
									</v-card-actions>
								</v-card>
							</v-dialog>
						</v-toolbar>
					</template>
					<template v-slot:item.actions="{ item }">
						<v-icon
							small
							class="mr-2"
							@click="editItem(item)"
						>
							mdi-pencil
						</v-icon>
						<v-icon
							small
							@click="deleteItem(item)"
						>
							mdi-delete
						</v-icon>
					</template>
					<template v-slot:no-data>
						<v-btn
							color="primary"
							@click="initialize"
						>
							Reset
						</v-btn>
					</template>
				</v-data-table>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
export default {
  name: "Dashboard",
  data: () => {
    return {
			dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'Numéro', value: 'id' },
				{ text: 'Nom', value: 'name' },
        { text: 'Date début', value: 'dateDebut' },
        { text: 'Date fin', value: 'dateFin' },
        { text: 'Etat', value: 'etat' },
				{ text: 'Token', value: 'token' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        dateDebut: '',
        dateFin: '',
        etat: '',
        token: '',
      },
      defaultItem: {
        name: '',
        dateDebut: '',
        dateFin: '',
        etat: '',
        token: '',
      },
		};
  },

	computed: {
		formTitle () {
			return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
		},
	},

	watch: {
		dialog (val) {
			val || this.close()
		},
		dialogDelete (val) {
			val || this.closeDelete()
		},
	},

	created () {
		this.initialize()
	},

	methods: {
      initialize () {
        this.desserts = [
          {
            name: 'Voyage en italie',
						dateDebut: '29/10/2020',
						dateFin: '29/11/2020',
						etat: 'Protégé',
						token: 'sfkjklf34sdqo23',
          },
        ]
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
	}
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
