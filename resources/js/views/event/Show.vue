<template>
  <div>
    <div class="mb-4">
      <router-link :to="{ name: 'home' }" class="btn btn-primary">Back to Listing</router-link>
    </div>

    <div v-if="loading">
      <loading-bars></loading-bars>
    </div>

    <div v-if="event" class="bg-white p-4 shaodw-sm rounded max-w-screen-md">
      <div class="flex items-center gap-5 mb-4">
        <div>
          <h2 class="text-2xl font-semibold tracking-wide text-indigo-900 mb-3">{{ event.title }}</h2>
          <div>
            <span class="text-gray-500">Start Date:</span> {{ getFormattedDate(event.start_date) }} <span class="text-gray-500">({{ event.start_date_hr }})</span>
          </div>
          <div>
            <span class="text-gray-500">End Date:</span> {{ getFormattedDate(event.end_date) }} <span class="text-gray-500">({{ event.end_date_hr }})</span>
          </div>
          <div class="mt-2">
            <router-link :to="{ name: 'events.edit', params: { id: event.id } }" class="btn btn-primary py-1 text-sm">Edit</router-link>
          </div>
        </div>
      </div>

      <div v-html="event.description"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      event: {},
      loading: true,
    };
  },

  created() {
    this.loadEvent();
  },

  methods: {
    loadEvent() {
      axios
        .get("/api/events/" + this.$route.params.id)
        .then((response) => {
          this.loading = false;
          this.event = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getFormattedDate(date) {
      let options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString("en-GB", options);
    },
  },
};
</script>