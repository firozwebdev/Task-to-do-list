<template>
    <div>
       
       <h2>Users List</h2>
       <a href="/users/create" class="btn btn-primary">Create user</a>
       <div class="alert alert-success" v-if="message">{{ message }}</div>
        <div class="col-md-6 col-md-offset-3">
            <table class="table-bordered table-striped">
               <tr>
                   <td>Id</td>
                   <td>Name</td>
                   <td>Email</td>
                   <td>Action</td>
               </tr>

               <tr v-for="(user, index) in users">
                <td> {{ user.id }}</td>
                <td> {{ user.name }}</td>
                <td> {{ user.email }}</td>
                <td style="width:27%">
                                
                        <a  :href="'/users/'+ user.id +'/edit'" class="btn btn-primary">Edit</a>
                        <a  class="btn btn-danger" @click.prevent="deleteUser(user.id, index)">Delete</a>
                </td>
               </tr>

            </table>
       
    </div>

    </div>
</template>

<script>
    export default {
       
        data(){
           return {
               user: {
                    name: '',
                    email: '',
               },
               users: [],
               message: '',
               
           }
            
        },
        mounted() {
           this.getUsers();
        },

        methods: {
            getUsers(){
                 axios.get('/api/users')
                    .then(response => {
                        this.users = response.data.users;
                    });
            },
            
            deleteUser(id, index){
                axios.delete('/api/users/'+id).then( response => {
                   this.users.splice(index,1);
                   //window.location.href = '/tasks';
                   console.log(response);
                   this.message = response.data.message;
                }).catch( error =>{
                    console.log(error);
                });
            },
            
        }
            
           
        

    }
</script>
