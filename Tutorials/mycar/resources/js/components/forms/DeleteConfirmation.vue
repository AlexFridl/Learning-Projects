<script>
export default {
    props: ["endpoint"],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    methods: {
        confirm: function confirm(e) {
            e.preventDefault();
            this.$toast.question(
                "Da li ste sigurni da želite da obrišete?",
                "Upozorenje!", {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: "once",
                    id: "question",
                    zindex: 999,
                    title: "Hey",
                    position: "center",
                    buttons: [
                        [
                            "<button><b>Da</b></button>",
                            (instance, toast) => {
                                this.$refs.form.submit();
                                instance.hide({
                                        transitionOut: "fadeOut",
                                    },
                                    toast,
                                    "button"
                                );
                            },
                        ],
                        [
                            "<button>Ne</button>",
                            (instance, toast) => {
                                instance.hide({
                                        transitionOut: "fadeOut",
                                    },
                                    toast,
                                    "button"
                                );
                            },
                        ],
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        // console.info("Closing | closedBy: " + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        // console.info("Closed | closedBy: " + closedBy);
                    },
                }
            );
        },
    },
};
</script>
