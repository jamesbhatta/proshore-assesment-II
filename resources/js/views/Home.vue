<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl md:text-3xl font-bold text-indigo-900 tracking-wide mb-4">Events</h1>
      <router-link :to="{ name: 'events.create' }" class="btn btn-primary">Add New</router-link>
    </div>

    <div class="flex items-center mb-4">
      <div class="ml-auto">
        <div class="filter-bar border rounded-l-lg divide-x">
          <button class="rounded-l-lg" type="button" v-on:click="filterByStatus()" :class="{ active: filterStatus == '' }">All</button>
          <button type="button" v-on:click="filterByStatus('finished')" :class="{ active: filterStatus == 'finished' }">Finished</button>
          <button type="button" v-on:click="filterByStatus('upcomming')" :class="{ active: filterStatus == 'upcomming' }">Upcomming</button>
          <button type="button" v-on:click="filterByStatus('upcomming-7-days')" :class="{ active: filterStatus == 'upcomming-7-days' }">Upcomming within 7 days</button>
          <button type="button" v-on:click="filterByStatus('finished-7-days')" :class="{ active: filterStatus == 'finished-7-days' }">Finished in last 7 days</button>
          <input type="text" v-model="search" class="border-t-0 border-b-0 form-input inline-block w-48" placeholder="Search..." />
        </div>
      </div>
    </div>

    <table class="custom-table table-hover bg-white shadow-sm">
      <thead>
        <tr>
          <th @click="sort('title')" class="cursor-pointer">
            <div class="flex w-full justify-between">
              <span>Title</span>
              <sort-arrow for="title" :currentSort="currentSort" :currentSortDir="currentSortDir"></sort-arrow>
            </div>
          </th>
          <th @click="sort('start_date')" class="cursor-pointer">
            <div class="flex w-full justify-between">
              <span>Start Date</span>
              <sort-arrow for="start_date" :currentSort="currentSort" :currentSortDir="currentSortDir"></sort-arrow>
            </div>
          </th>
          <th @click="sort('end_date')" class="cursor-pointer">
            <div class="flex w-full justify-between">
              <span>End Date</span>
              <sort-arrow for="end_date" :currentSort="currentSort" :currentSortDir="currentSortDir"></sort-arrow>
            </div>
          </th>
          <th><div class="text-right cursor-pointer">Action</div></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in events.data" :key="event.id">
          <td>{{ event.title }}</td>
          <td>{{ getFormattedDate(event.start_date) }}</td>
          <td>{{ getFormattedDate(event.end_date) }}</td>
          <td class="text-right">
            <router-link :to="{ name: 'events.show', params: { id: event.id } }" class="text-indigo-500 hover:underline">View</router-link>
            <span class="mx-2 text-gray-300">|</span>
            <router-link :to="{ name: 'events.edit', params: { id: event.id } }" class="text-indigo-500 hover:underline">Edit</router-link>
            <span class="mx-2 text-gray-300">|</span>
            <button @click="destroyEvent(event.id)" class="text-red-500 hover:underline">Delete</button>
          </td>
        </tr>
      </tbody>
      <tr v-if="!loadingEvents && events.data && events.data.length == 0">
        <td colspan="42">
          <div class="bg-white py-8 px-3 text-center italic font-2xl rounded shadow-sm">No Records Found</div>
        </td>
      </tr>
    </table>

    <div v-if="!loadingEvents && events.data && events.data.length" class="mt-4">
      <VueTailwindPagination :current="events.meta.current_page" :total="events.meta.total" :per-page="events.meta.per_page" @page-changed="page = $event" />
    </div>
  </div>
</template>

<script>
import SortArrow from "../components/SortArrow.vue";
import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";

export default {
  components: { SortArrow, VueTailwindPagination },
  data() {
    return {
      loadingEvents: false,
      events: [],
      page: 1,

      filterStatus: "",
      search: null,

      currentSort: "start_date",
      currentSortDir: "desc",
    };
  },

  mounted() {
    this.loadEvents();
  },

  methods: {
    loadEvents() {
      this.loadingEvents = true;
      let url = new URL(window.location.origin + "/api/events");
      url.searchParams.append("page", this.page);
      if (this.search) {
        url.searchParams.append("filter[title]", this.search);
      }
      if (this.filterStatus) {
        url.searchParams.append("filter[status]", this.filterStatus);
      }
      url.searchParams.append("sort", this.currentSortDir == "desc" ? "-" + this.currentSort : this.currentSort);

      axios
        .get(url)
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

    filterByStatus(status = "") {
      this.filterStatus = status;
    },

    sort(s) {
      if (s == this.currentSort) {
        this.currentSortDir = this.currentSortDir == "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
      this.loadEvents();
    },

    getFormattedDate(date) {
      let options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString("en-GB", options);
    },
  },

  watch: {
    page() {
      this.loadEvents();
    },

    filterStatus() {
      this.page = 1;
      this.loadEvents();
    },

    search() {
      this.loadEvents();
    },
  },
};
</script>
