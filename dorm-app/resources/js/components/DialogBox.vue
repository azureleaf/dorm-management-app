<template>
  <v-content>
    <v-container>
      <v-dialog v-model="isDialogOpen" persistent max-width="600px">
        <template v-slot:activator="{ on }">
          <v-btn color="error" depressed right absolute dark v-on="on">
            <v-icon class="mr-1">mdi-security</v-icon>
            {{ cardtitle }}
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ cardtitle }}</span>
          </v-card-title>
          <v-card-subtitle>{{ cardsubtitle }}</v-card-subtitle>
          <v-card-text>
            <slot name="dialogcontent"></slot>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <!-- close the dialog box by any click event inside the slot-->
            <div @click="isDialogOpen = false">
              <slot name="dialogaction"></slot>
            </div>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </v-content>
</template>

<script>
export default {
  props: {
    cardtitle: String,
    cardsubtitle: String
  },
  data: function() {
    return {
      isDialogOpen: false
    };
  }
};
</script>
<style scoped>
</style>
