<template>
  <div
    class="card bg-white border-0 mb-3"
    v-for="status in statuses"
    :key="status.id"
    @click="redirectIfGuest"
  >
    <div class="card-body d-flex flex-column shadow-sm">
      <div class="d-flex align-items-center mb-3">
        <img
          :src="status.user_avatar"
          alt="image de perfil"
          :width="40"
          style="margin-right: 10px"
          class="rounded"
        />
        <div>
          <h5 class="mb-1" v-text="status.name"></h5>
          <div class="small text-muted" v-text="status.ago"></div>
        </div>
      </div>
      <p class="card-text text-secondary">{{ status.body }}</p>
    </div>
    <div class="card-footer p-2">
      <button
        class="btn btn-link px-2"
        v-if="status.is_liked"
        @click="unlike(status)"
      >
        <strong> <i class="fa-solid fa-thumbs-up me-2"></i> TE GUSTA </strong>
      </button>
      <button class="btn btn-link px-2" v-else @click="like(status)">
        <i class="fa-solid fa-heart me-2"></i>
        ME GUSTA
      </button>
      <span>{{ status.likes_count }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "StatutesList",
  data() {
    return {
      statuses: [],
    };
  },
  methods: {
    like(status) {
      axios.post(`/statuses/${status.id}/likes`).then(() => {
        status.is_liked = true;
        status.likes_count++;
      });
    },
    unlike(status) {
      axios.delete(`/statuses/${status.id}/likes`).then(() => {
        status.is_liked = false;
        status.likes_count--;
      });
    },
  },
  mounted() {
    axios.get("statuses").then(({ data: response }) => {
      this.statuses = response.data;
    });
    this.emitter.on("status-created", (status) => {
      this.statuses.unshift(status.data);
    });
  },
};
</script>

<style>
.btn-link {
  text-decoration: none;
  font-weight: normal;
}
</style>
