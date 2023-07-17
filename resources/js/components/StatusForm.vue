<template>
  <form @submit.prevent="handlerSubmit" v-if="isAuthenticated">
    <div class="card bg-light border-0 shadow-sm">
      <div class="card-body">
        <textarea
          class="form-control border-0 bg-light"
          name="body"
          id="body"
          v-model="body"
          :placeholder="`¿Qué estás ${user.name}?`"
        ></textarea>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary" id="create-status">
          <i class="fa-solid fa-paper-plane me-2"></i> Publicar
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "StatusForm",
  data() {
    return {
      body: "",
    };
  },
  methods: {
    handlerSubmit() {
      axios
        .post("/statuses", { body: this.body })
        .then(({ data: response }) => {
          this.body = "";
          this.emitter.emit("status-created", response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style></style>
