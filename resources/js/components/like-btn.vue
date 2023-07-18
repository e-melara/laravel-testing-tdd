<script>
export default {
  name: 'LikeBtn',
  props: {
    model: {
      type: Object,
      required: true,
    },
    url: {
      type: String,
      required: true,
    }
  },
  methods: {
    likeOrUnLiked() {
      const method = this.model.is_liked ? 'delete' : 'post';
      axios[method](this.url).then(() => {
        this.model.is_liked = !this.model.is_liked;
        this.model.likes_count = method === 'post' ? this.model.likes_count++ : this.model.likes_count--;
      });
    },
  },
  computed: {
    getText() {
      return this.model.is_liked ? 'TE GUSTA' : 'ME GUSTA';
    },
    getClassBtn() {
      return [
        'btn',
        'btn-link',
        'px-2',
        this.model.is_liked ? 'text-primary' : 'text-secondary',
        this.model.is_liked ? 'fw-bold' : '',
      ]
    },
    getClassIcon() {
      return [
        'me-2',
        'fa-solid',
        this.model.is_liked ? 'fa-thumbs-up' : 'fa-heart',
      ]
    }
  }
}
</script>

<template>
  <button
    :class="getClassBtn"
    @click="likeOrUnLiked(model)"
  >
    <i :class="getClassIcon"></i> {{ getText }}
  </button>
</template>

<style scoped>

</style>
