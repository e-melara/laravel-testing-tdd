const user = document.head.querySelector('meta[name="user"]');

export default {
  computed: {
    user() {
      return JSON.parse(user.content);
    },
    isAuthenticated() {
      return !!user.content;
    },
  },
};
