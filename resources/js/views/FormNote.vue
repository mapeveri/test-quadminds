<template>
    <div class="col-md-12">
        <br>
        <div class="card">
            <div class="card-body">
                <h1>{{ titleForm }}</h1>
                <img id="loading" style="display: none" src="/img/ajax.gif" />
                <hr>

                <form class="container form">
                    <div class="form-group" v-bind:class="{ 'is-invalid' : !title }">
                        <label>Title</label>
                        <input type="text" v-model="title" required="required" class="form-control" id="title" />
                    </div>

                    <div class="form-group" v-bind:class="{ 'is-invalid' : !content }">
                        <label>Content</label>
                        <textarea v-model="content" required="required" class="form-control" id="content" />
                    </div>

                    <button type="button" v-on:click="Save()" :disabled="isDisabled" class="btn btn-sm btn-primary">Save</button>
                    <a href="/" class="btn btn-sm btn-primary">Back</a>
                    <br>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                titleForm: '',
                title: '',
                content: ''
            }
        },
        mounted() {
            if (this.$route.params.id === undefined) {
                this.titleForm = 'Add note';
            } else {
                this.titleForm = 'Edit note';
                this.GetNote(this.$route.params.id);
            }
        },
        computed: {
            isDisabled() {
                return (!this.title || !this.content)
            }
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
            /**
            * @method Save
            * @description Create or edit note
            */
            Save() {
                document.getElementById("loading").removeAttribute("style");

                const params = {
                    title: this.title,
                    content: this.content
                };

                if (this.$route.params.id === undefined) {
                    axios.post('/notes', params).then((response) => {
                        document.getElementById("loading").style = "display: none";
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        document.getElementById("loading").style = "display: none";
                        swal('Information', 'Error to create record', 'error');
                    });
                } else {
                    axios.patch(`/notes/${this.$route.params.id}`, params).then((response) => {
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        document.getElementById("loading").style = "display: none";
                        swal('Information', 'Error to update record', 'error');
                    });
                }
            }
        }
    }
</script>
