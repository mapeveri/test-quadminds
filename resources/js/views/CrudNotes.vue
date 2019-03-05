<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <div class="card">
                    <div class="card-header">Notes</div>

                    <div class="card-body">
                        <div class="float-left">
                            <img id="loading" style="display: none" src="/img/ajax.gif" />
                        </div>
                        <div class="float-right">
                            <button type="button" v-on:click="AddNote()" class="btn btn-sm btn-primary">Add</button><br><br>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-for="(record, key) in notes" :key="record.id">
                                <tr>
                                    <td>{{ record.title }}</td>
                                    <td>{{ record.content }}</td>
                                    <td>
                                        <input type="button" class="btn btn-sm btn-info" v-on:click="ShowNote(record.id)" value="Show" />
                                        <input type="button" class="btn btn-sm btn-secondary" v-on:click="EditNote(record.id)" value="Edit" />
                                        <input type="button" class="btn btn-sm btn-danger" v-on:click="DeleteNote(record.id, key)" value="Delete" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        data() {
            return {
                notes: []
            }
        },
        mounted() {
            this.GetNotes();
        },
        methods: {
            /**
            * @method GetNotes
            * @description Get all notes
            */
            GetNotes() {
                const self = this;
                document.getElementById("loading").removeAttribute("style");

                axios.get('/notes')
                    .then((response) => {
                        document.getElementById("loading").style = "display: none";
                        self.notes = response.data.data;
                    })
                    .catch((error) => {
                        document.getElementById("loading").style = "display: none";
                        swal('Information', 'Error to get notes', 'error');
                    });
            },
            /**
            * @method AddNote
            * @description Redirect to form
            */
            AddNote() {
                this.$router.push('/new');
            },
            /**
            * @method ShowNote
            * @description Redirect to show note
            * @param id
            */
            ShowNote(id) {
                this.$router.push(`/show/${id}`);
            },
            /**
            * @method EditNote
            * @description Redirect to edit form
            * @param id
            */
            EditNote(id) {
                this.$router.push(`/edit/${id}`);
            },
            /**
            * @method DeleteNote
            * @description Delete note
            * @param id
            * @param key
            */
            DeleteNote(id, key) {
                const self = this;

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById("loading").removeAttribute("style");

                        axios.delete(`/notes/${id}`).then((response) => {
                            document.getElementById("loading").style = "display: none";
                            if (response.data.data) {
                                self.notes.splice(key, 1);
                            }
                        })
                        .catch((error) => {
                            document.getElementById("loading").style = "display: none";
                            alertify.error('Error to delete record');
                        });
                    }
                });

            }
        }
    }
</script>
