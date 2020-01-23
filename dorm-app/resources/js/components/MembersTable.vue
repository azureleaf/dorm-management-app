<template>
  <div id="app">
    <!-- <v-app> -->
      <h1>Example Vue Component</h1>
      <p>I'm an example component.</p>
      <h2>v-for</h2>
      <ul>
        <li
          v-for="(country, i) in countries"
          :key="i"
        >Capital city of {{ country.name }} is {{ country.capital }}</li>
      </ul>
    <!-- </v-app> -->
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      countries: [
        { name: "China", capital: "Beijing" },
        { name: "Japan", capital: "Tokyo" },
        { name: "Korea", capital: "Seoul" }
      ]
    };
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
