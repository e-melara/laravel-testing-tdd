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
      <div class="d-flex mb-2">
        <img
          :src="comment.user_avatar"
          :alt="comment.user_name"
          width="45"
          height="45"
          class="rounded shadow-sm float-left me-3"
        />
        <div class="flex-grow-1">
          <div class="card bg-white border-0 shadow-sm mb-2">
            <div class="card-body">
              <a href="#" class="text-decoration-none font-weight-bold">
                {{ comment.user_name }}
              </a>
              {{ comment.body }}
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <like-btn class="comment-btn-like" :model="comment" :url="`/comments/${comment.id}/likes`"/>
            <small class="badge rounded-pill text-bg-primary float-end">
              <i class="fa fa-thumbs-up"></i>
              {{ comment.likes_count }}
            </small>
          </div>
        </div>
      </div>
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

<style lang="scss">
.comment-btn-like {
  font-size: 0.8rem;

  i.fa-solid {
    display: none;
  }
}
</style>
