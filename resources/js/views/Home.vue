<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl md:text-3xl font-bold text-indigo-900 tracking-wide mb-4">Events</h1>
      <router-link :to="{ name: 'events.create' }" class="btn btn-primary">Add New</router-link>
    </div>

    <table class="custom-table table-hover bg-white shadow-sm">
      <thead>
        <tr>
          <th>Title</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th><div class="text-right cursor-pointer">Action</div></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in events.data" :key="event.id">
          <td>{{ event.title }}</td>
          <td>{{ event.start_date_hr }}</td>
          <td>{{ event.end_date }}</td>
          <td>
            <router-link :to="{ name: 'events.show', params: { id: event.id } }" class="text-indigo-500 hover:underline">View</router-link>
            <span class="mx-2">|</span>
            <router-link :to="{ name: 'events.edit', params: { id: event.id } }" class="text-indigo-500 hover:underline">Edit</router-link>
            <span class="mx-2">|</span>
            <button @click="destroyEvent(event.id)" class="text-red-500 hover:underline">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loadingEvents: false,
      events: [],
    };
  },

  mounted() {
    this.loadEvents();
  },

  methods: {
    loadEvents() {
      this.loadingEvents = true;
      axios
        .get("/api/events")
        .then((response) => {
          this.events = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loadingEvents = false;
        });
    },

    destroyEvent(id) {
      if (confirm("Are you sure you want to delete this event?")) {
        axios
          .delete("/api/events/" + id)
          .then((response) => {
            this.$notify("Event deleted successfully");
            this.loadEvents();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>
