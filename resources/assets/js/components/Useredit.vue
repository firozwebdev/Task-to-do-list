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

            <!-- <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" v-model="user.password" class="form-control" id="password" placeholder="Password">
            </div> -->

            <button type="submit" @click="updateUser()">Update User</button>
       </div>

    </div>
</template>

<script>
    export default {
        props: ['id'],
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
           this.showUser(this.id);
        },

        methods: {
            showUser(id){
                
            
                axios.get('/api/users/'+id, {
                                
                    }).then( response => {
                        var user = response.data.user;
                        this.user.name = user.name;
                        this.user.email = user.email;
                       // this.user.password = user.password;

                    }).catch( error => {
                        console.log(error);
                    })
            
            },
            updateUser(){
                 axios.put('/api/users/'+this.id, {
                      name: this.user.name, 
                      email: this.user.email, 
                      
                    }).then( response => {
                        this.message = response.data.message;
                    }).catch( error => {
                        console.log(error);
                    });
                     window.location.href = '/users';
                    
            }

        },
        

    }
</script>
