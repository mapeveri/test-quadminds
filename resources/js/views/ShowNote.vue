<template>
    <div class="col-md-12">
        <br>
        <div class="card">
            <div class="card-body">
                <h1>Note</h1>
                <hr>

                <p>Title: {{ title }}</p>
                <p>Content: {{ content }}</p>

                <a href="/" class="btn btn-sm btn-primary">Back</a>
                <img id="loading" style="display: none" src="/img/ajax.gif" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                titleForm: '',
                title: '',
                content: ''
            }
        },
        mounted() {
            this.GetNote(this.$route.params.id);
        },
        methods: {
            /**
            * @method GetNote
            * @description Get note
            * @param id
            */
            GetNote(id) {
                const self = this;
                document.getElementById("loading").removeAttribute("style");

                axios.get(`/notes/${id}`)
                    .then((response) => {
                        document.getElementById("loading").style = "display: none";

                        self.title = response.data.data.title;
                        self.content = response.data.data.content;
                    })
                    .catch((error) => {
                        document.getElementById("loading").style = "display: none";
                        swal('Information', 'Error to get note', 'error');
                    });
            },
        }
    }
</script>
