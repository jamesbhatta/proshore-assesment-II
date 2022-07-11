<template>
  <div>
    <span class="text-2xl md:text-3xl font-medium text-indigo-900 tracking-wide mb-4">Create New Event</span>
    <div class="my-5"></div>
    <errors type="danger" v-if="errors" :content="errors" @close="errors = null" class="mb-3"></errors>

    <div class="bg-white rounded shadow-sm max-w-screen-md">
      <form @submit.prevent="submit">
        <div class="p-5">
          <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
              <text-input type="text" v-model="event.title" label="Title"></text-input>
            </div>
            <div class="col-span-6">
              <text-input type="date" v-model="event.start_date" label="Start Date"></text-input>
            </div>
            <div class="col-span-6">
              <text-input type="date" v-model="event.end_date" label="End Date"></text-input>
            </div>
            <div class="col-span-12">
              <label class="form-label">Description</label>
              <textarea v-model="event.description" class="form-input" cols="30" rows="10"></textarea>
            </div>
            <!-- <div class="col-span-6">
              <label class="form-label">Profile Pic:</label>
              <div class="flex items-center space-x-4">
                <input type="file" class="form-input" @change="handleImageUpload" accept="image/*" />
                <img v-if="avatarPreview" class="inline-block h-10 w-10 rounded-full" :src="avatarPreview" />
              </div>
            </div> -->
          </div>
        </div>
        <div class="p-5 bg-purple-50 text-right">
          <processing-button :state="processing"> {{ updateMode ? "Update" : "Add" }} Event </processing-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Errors from "../../components/Errors.vue";
import TextInput from "../../components/TextInput.vue";
export default {
  components: { TextInput, Errors },
  data() {
    return {
      updateMode: false,
      processing: false,
      errors: null,
      event: {
        title: "",
        start_date: null,
        end_date: null,
        description: "",
      },
    };
  },

  created() {
    if (this.$route.params.id) {
      this.updateMode = true;
      this.loadEvent(this.$route.params.id);
    }
  },

  methods: {
    submit() {
      this.processing = true;
      if (this.updateMode) {
        this.update();
      } else {
        this.create();
      }
    },

    create() {
      this.errors = null;
      let formData = this.event;
      axios
        .post("/api/events", formData)
        .then((response) => {
          console.log(response);
          this.$notify("Event has been added.");
          this.$router.push({ name: "events.show", params: { id: response.data.id } });
        })
        .catch((err) => {
          this.errors = err.response.data;
        })
        .finally(() => {
          this.processing = false;
        });
    },

    loadEvent() {
      axios
        .get("/api/events/" + this.$route.params.id)
        .then((response) => {
          this.loading = false;
          let data = response.data.data;
          this.event.id = data.id;
          this.event.title = data.title;
          this.event.start_date = new Date(data.start_date).toISOString().split('T')[0];
          this.event.end_date = new Date(data.end_date).toISOString().split('T')[0];
          this.event.description = data.description;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    update() {
      this.errors = null;
      let formData = this.event;
      axios
        .put(`/api/events/${this.event.id}`, formData)
        .then((response) => {
          console.log(response);
          this.$notify("Event has been updated.");
          this.$router.push({ name: "events.show", params: { id: response.data.data.id } });
        })
        .catch((err) => {
          this.errors = err.response.data;
        })
        .finally(() => {
          this.processing = false;
        });
    },
  },
};
</script>