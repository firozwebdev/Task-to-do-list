<template>
<div class="columns">
        <div class="col-md-6 col-md-offset-3" style="margin-top:50px;">
               
                <a href="/tasks/create" class="btn btn-success">Add Task</a>
                
                <table class="table table-striped table-bordered" v-if="tasks.length">
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
                            <td>{{ index+1 }}</td>
                            <td>{{ task.title }}</td>
                            <td>{{ task.description }}</td>
                            <td style="width:15%">
                                
                                 <a  :href="'/tasks/'+ task.id +'/edit'" class="btn btn-primary">Edit</a>
                                 <a href="" class="btn btn-danger" @click.prevent="deleteTask(task.id, index)">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
        </div>
</div>

</template>

<script>
    export default {
         data() {
            return {
                task: {
                    title: '',
                    description: ''
                },
                tasks: [],
                
            }
         },   
            
            
        mounted(){
            this.readTasks();
        },

         methods: {
            readTasks() {
                axios.get('/api/tasks')
                    .then(response => {
                        this.tasks = response.data.tasks;
                    });
            },

            deleteTask(id, index){
                axios.delete('/api/tasks/'+id).then( response => {
                  // this.tasks.splice(index);
                   window.location.href = '/tasks';
                }).catch( error =>{
                    console.log(error);
                });
            },

         },

          

    }
</script>
