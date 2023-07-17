const user = document.head.querySelector('meta[name="user"]');

export default {
  computed: {
    user() {
      return JSON.parse(user.content);
    },
    isAuthenticated() {
      return !!user.content;
    },
    isGuest() {
      return !user.content;
    },
  },
  methods: {
    redirectIfGuest() {
      if (this.isGuest) {
        window.location.href = "/login";
      }
    },
  },
};
