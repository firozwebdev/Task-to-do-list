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
                <label for="name">Name</label>
                <input type="text" name="name" v-model="user.name" class="form-control" id="name" placeholder="Name">
            </div>
            

            <div class="form-group">
                <label for="email">Email</label>
                <input type="emal" name="email" v-model="user.email" class="form-control" id="email" placeholder="Email">
                
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" v-model="user.password" class="form-control" id="password" placeholder="Password">
            </div>

            <button type="submit" @click="createUser()">Create User</button>
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
                    password: '',
                    admin: 0,
               },
               users: [],
               errors: [],
               message: '',
           }
            
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            
            createUser(){
                 axios.post('/api/users/', {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                }).then(response => {
                    this.reset();
                    this.users.push(response.data.user);
                    this.message = response.data.message;
                    
                }).catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name[0]);
                    }

                    if (error.response.data.errors.email) {
                        this.errors.push(error.response.data.errors.email[0]);
                    }
                    if (error.response.data.errors.password) {
                        this.errors.push(error.response.data.errors.password[0]);
                    }
                });
                window.location.href = '/users'
            },

            //utility functions
             reset() {
                this.user.name = '';
                this.user.email = '';
                this.user.password = '';
                
            },
        },
        

    }
</script>
