
<template>
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <div>
                    <p>
                        <label>Tasks</label>
                        <a class="button is-info is-pulled-right" @click="initAddTask()">
                            <span class="icon is-small">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span>Add New Task</span>
                        </a>
                    </p>
                </div>
                <table class="table is-hoverable is-fullwidth is-striped" v-if="tasks.length">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(task, index) in tasks">
                            <td>{{ index + 1 }}</td>
                            <td>{{ task.title }}</td>
                            <td>{{ task.description }}</td>
                            <td>
                                <button @click="initUpdate(index)" class="button is-small is-info is-outlined">Edit</button>
                                <button @click="initDeleteTask(index)" class="button is-small is-danger is-outlined">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

<div class="container">
    <h2>Modal Example</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
  
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>


         <!-- /addTaskModal -->

        

    </div>
</template>

<script>
    export default {
        data() {
            return {
                delete_task: {},
                delete_task_index: null,
                errors: [],
                task: {
                    title: '',
                    description: ''
                },
                tasks: [],
                update_task: {}
            }
        },

        mounted() {
            this.readTasks();
        },

        methods: {
            closeModal() {
                $(".modal").removeClass("is-active");
            },

            createTask() {
                axios.post('/api/tasks/', {
                    title: this.task.title,
                    description: this.task.description,
                }, {
                    headers: { Authorization: '123 456' }
                })
                .then(response => {
                    this.reset();
                    this.tasks.push(response.data.task);

                    this.closeModal();
                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.title) {
                        this.errors.push(error.response.data.errors.title[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
            },

            deleteTask() {
                axios.delete('/api/tasks/' + this.tasks[this.delete_task_index].id)
                    .then(response => {
                        this.tasks.splice(this.delete_task_index, 1);
                        this.closeModal();
                    })
                    .catch(error => {

                    });
            },

            initAddTask() {
                $("#addTaskModal").addClass("is-active");
            },

            initDeleteTask(index) {
                $("#deleteTaskModal").addClass("is-active");
                this.delete_task = this.tasks[index];
                this.delete_task_index = index;
            },

            initUpdate(index) {
                this.errors = [];
                $("#updateTaskModal").addClass("is-active");
                this.update_task = this.tasks[index];
            },

            readTasks() {
                axios.get('/api/tasks/')
                    .then(response => {
                        this.tasks = response.data.tasks;
                    });
            },

            reset() {
                this.task.title = '';
                this.task.description = '';
            },

            updateTask() {
                axios.patch('/api/tasks/' + this.update_task.id, {
                    title: this.update_task.title,
                    description: this.update_task.description,
                })
                .then(response => {
                    this.closeModal();
                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.title) {
                        this.errors.push(error.response.data.errors.title[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
            },
        }
    }
</script>
