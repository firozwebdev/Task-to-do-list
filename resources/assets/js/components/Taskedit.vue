<template>
    <div>
       <div class="col-md-6 col-md-offset-3" style="margin-top:50px;">
           
                <div class="aler alert-danger" v-if="errors.length > 0">
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>
            <div class="alert alert-success" v-if="message">{{ message }}</div>
           <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" v-model="task.title" class="form-control" id="title" placeholder="Title">
                
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" v-model="task.description" id="" cols="30" rows="10"></textarea>
                
            </div>
            <button type="submit" @click="updateTask()">Update Task</button>
       </div>

    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
           return {
               task: {
                    title: '',
                    description: '',
               },
               tasks: [],
               errors: [],
               message: '',
           }
            
        },
        mounted() {
           this.showTask(this.id);
        },

        methods: {


            showTask(id){
                axios.get('/api/tasks/'+id, {
                                
                    }).then( response => {
                    var task = response.data.task;
                        this.task.title = task.title;
                        this.task.description = task.description;

                    }).catch( error => {
                        console.log(error);
                    })
            },

            updateTask(){
                axios.put('/api/tasks/'+this.id, {
                      title: this.task.title, 
                       description: this.task.description, 
                    }).then( response => {
                        this.message = response.data.message;
                    }).catch( error => {
                        console.log(error);
                    });
                     window.location.href = '/tasks';
                },

            //utility functions
             reset() {
                this.task.title = '';
                this.task.description = '';
            },
        },
        

    }
</script>
