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
          <h2 class="text-2xl font-semibold tracking-wide text-indigo-900">{{ event.title }}</h2>
          <div>{{ event.start_date }}</div>
          <div class="mt-2">
            <router-link :to="{ name:'events.edit', params:{ id: event.id }}" class="btn btn-primary py-1 text-sm">Edit</router-link>
          </div>
        </div>
      </div>

      <div v-html="event.description"></div>



      <!-- <div class="">
        <table class="table-auto w-full">
          <tbody>
            <tr>
              <td class="py-4 px-5 border-b">Email</td>
              <td class="py-4 px-5 border-b">{{ user.email }}</td>
            </tr>
            <tr>
              <td class="py-4 px-5 border-b">Role</td>
              <td class="py-4 px-5 border-b">{{ user.role_string }}</td>
            </tr>
            <tr>
              <td class="py-4 px-5 border-b">Department</td>
              <td class="py-4 px-5 border-b">{{ user.department.name }}</td>
            </tr>
            <tr>
              <td class="py-4 px-5 border-b">Salary</td>
              <td class="py-4 px-5 border-b">{{ user.salary_formatted }}</td>
            </tr>
            <tr>
              <td class="py-4 px-5 border-b">Joining Date</td>
              <td class="py-4 px-5 border-b">{{ user.joining_date_formatted }}</td>
            </tr>
            <tr>
              <td class="py-4 px-5 border-b">Address</td>
              <td class="py-4 px-5 border-b">{{ user.address }}</td>
            </tr>
            <tr v-if="user.department">
              <td class="py-4 px-5 border-b">Department</td>
              <td class="py-4 px-5 border-b">{{ user.department.name }}</td>
            </tr>
          </tbody>
        </table>
      </div> -->
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
  },
};
</script>