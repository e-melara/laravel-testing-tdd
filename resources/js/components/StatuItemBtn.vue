<template>
  <div
    class="card-footer p-2 d-flex justify-content-between align-items-center"
  >
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
      <span>{{comment.count_likes}}</span>
      <button v-if="comment.is_liked" @click="unLikeComment(comment)">TE GUSTA</button>
      <button v-else @click="likeComment(comment)">ME GUSTA</button>
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
export default {
  name: "StatusItemBtn",
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
        .then(({ data: response }) => {
          this.status.comments.push(response.data);
          this.newComment = "";
        });
    },
    like() {
      axios.post(`/statuses/${this.status.id}/likes`).then(() => {
        this.status.is_liked = true;
        this.status.likes_count++;
      });
    },
    unlike() {
      axios.delete(`/statuses/${this.status.id}/likes`).then(() => {
        this.status.is_liked = false;
        this.status.likes_count--;
      });
    },
    likeComment(comment) {
      axios.post(`/comments/${comment.id}/likes`).then(() => {
        comment.is_liked = true;
        comment.count_likes++;
      }).catch(err => {
        console.log(err);
      });
    },
    unLikeComment(comment) {
      axios.delete(`/comments/${comment.id}/likes`).then(() => {
        comment.is_liked = false;
        comment.count_likes--;
      }).catch(err => {
        console.log(err);
      });
    },
  },
};
</script>

<style></style>
