<template>
  <div
    class="card bg-white border-0 mb-3"
    v-for="status in statuses"
    :key="status.id"
    @click="redirectIfGuest"
  >
    <StatusListItem :status="status" />
    <StatuItemBtn :status="status" />
  </div>
</template>

<script>
import StatusListItem from "./StatusListItem.vue";
import StatuItemBtn from "./StatuItemBtn.vue";

export default {
  name: "StatutesList",
  components: {
    StatusListItem,
    StatuItemBtn,
  },
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
