<template>
  <form-group>
    <label v-if="label" class="form-label">{{ label }}:</label>
    <input
      :type="type"
      class="form-input"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      ref="input"
    />
  </form-group>
</template>

<script>
import FormGroup from "./FormGroup.vue";
export default {
  components: { FormGroup },
  props: {
    type: {
      type: String,
      default: "text"
    },
    modelValue: String,
    label: String,
  },
  emits: ["update:modelValue"],
  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
