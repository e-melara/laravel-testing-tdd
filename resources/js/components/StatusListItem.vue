<template>
  <div class="card-body d-flex flex-column shadow-sm">
    <div class="d-flex align-items-center mb-3">
      <img
        :src="status.user_avatar"
        alt="image de perfil"
        :width="40"
        class="rounded me-3"
      />
      <div>
        <h5 class="mb-1">
          <a :href="status.user_link" v-text="status.user_name"></a>
        </h5>
        <div class="small text-muted" v-text="status.ago"></div>
      </div>
    </div>
    <p class="card-text text-secondary">{{ status.body }}</p>
  </div>
</template>

<script>
export default {
  name: "StatutListItem",
  props: {
    status: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style></style>
