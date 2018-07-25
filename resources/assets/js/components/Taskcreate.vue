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
            <button type="submit" @click="createTask()">Create Task</button>
       </div>

    </div>
</template>

<script>
    export default {

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
            console.log('Component mounted.')
        },

        methods: {
            
            createTask(){
                 axios.post('/api/tasks/', {
                    title: this.task.title,
                    description: this.task.description,
                }).then(response => {
                    this.reset();
                    this.tasks.push(response.data.task);
                    this.message = response.data.message;
                    
                }).catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.title) {
                        this.errors.push(error.response.data.errors.title[0]);
                    }

                    if (error.response.data.errors.description) {
                        this.errors.push(error.response.data.errors.description[0]);
                    }
                });
            },

            //utility functions
             reset() {
                this.task.title = '';
                this.task.description = '';
            },
        },
        

    }
</script>
