<template>
  <div
    class="card-footer p-2 d-flex justify-content-between align-items-center"
  >
    <like-btn :model="status" :url="`/statuses/${this.status.id}/likes`"/>
    <div class="text-secondary">
      <i class="fa-solid fa-thumbs-up me-2"></i>
      {{ status.likes_count }}
    </div>
  </div>
  <div class="card-footer">
    <div v-for="(comment, index) in status.comments" :key="index">
      <img
        :src="comment.user_avatar"
        :alt="comment.user_name"
        width="45"
        class="rounded shadow-sm float-left me-3"
      />
      <div class="card bg-white border-0 shadow-sm mb-3">
        <div class="card-body">
          <a href="#" class="text-decoration-none font-weight-bold">
            {{ comment.user_name }}
          </a>
          {{ comment.body }}
        </div>
      </div>
      <span>{{ comment.count_likes }}</span>
      <like-btn :model="comment" :url="`/comments/${comment.id}/likes`"/>
    </div>
    <form
      class="d-flex justify-between align-items-center"
      @submit.prevent="sendComment"
    >
      <img
        src="/images/avatar.jpg"
        alt="avatar usuario"
        width="40"
        class="rounded shadow-sm float-left me-3"
      />
      <div class="input-group">
        <textarea
          name="comment"
          rows="1"
          v-model="newComment"
          class="bg-white border-0 shadow-sm form-control"
        ></textarea>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>
  </div>
</template>

<script>
import LikeBtn from "./like-btn.vue";

export default {
  name: "StatusItemBtn",
  components: {
    LikeBtn,
  },
  data() {
    return {
      newComment: "",
    };
  },
  props: {
    status: {
      type: Object,
      required: true,
    },
  },
  methods: {
    sendComment() {
      axios
        .post(`/statuses/${this.status.id}/comments`, {
          body: this.newComment,
        })
        .then(({data: response}) => {
          this.status.comments.push(response.data);
          this.newComment = "";
        });
    },
  },
};
</script>

<style></style>
