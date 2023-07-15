<template>
  <div
    class="card bg-white border-0 mb-3"
    v-for="status in statuses"
    :key="status.id"
  >
    <div class="card-body d-flex flex-column shadow-sm">
      <div class="d-flex align-items-center mb-3">
        <img
          src="/images/avatar-.jpg"
          alt="image de perfil"
          :width="40"
          style="margin-right: 10px"
          class="rounded"
        />
        <div>
          <h5 class="mb-1">Edwin Melara Landaverde</h5>
          <div class="small text-muted">Hace una hora</div>
        </div>
      </div>
      <p class="card-text text-secondary">{{ status.body }}</p>
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
  mounted() {
    axios.get("statuses").then(({ data: response }) => {
      this.statuses = response.data;
    });
    this.emitter.on("status-created", (status) => {
      this.statuses.unshift(status);
    });
  },
};
</script>

<style></style>
